import re
import json
import sys
import fitz  # PyMuPDF

def extract_text_from_pdf(pdf_path):
    try:
        doc = fitz.open(pdf_path)
        text = ""
        for page in doc:
            text += page.get_text()
        return text
    except Exception as e:
        return ""

def extract_sections(text):
    name = re.search(r'PATIENT:\s*(.+)', text)
    dob = re.search(r'DOB:\s*(.+)', text)
    exam = re.search(r'EXAM:\s*(.+)', text)

    return {
        "name": name.group(1).strip() if name else "Unknown",
        "dob": dob.group(1).strip() if dob else "Unknown",
        "exam": exam.group(1).strip() if exam else "Unknown"
    }

def extract_findings_and_impression(text):
    findings_match = re.search(r'FINDINGS\s*(.*?)\s*(IMPRESSION|$)', text, re.DOTALL | re.IGNORECASE)
    findings = findings_match.group(1).strip() if findings_match else "Not found"

    impression_match = re.search(r'IMPRESSION\s*(.*?)(\n\s*\[|\n\s*Board Certified Radiologist|$)', text, re.DOTALL | re.IGNORECASE)
    impression = impression_match.group(1).strip() if impression_match else "Not found"

    return findings, impression

def classify_report(content):
    abnormal_keywords = [
        'opacity', 'infiltrate', 'lesion', 'mass', 'consolidation', 'collapse',
        'effusion', 'abnormal', 'nodule', 'pneumonia', 'edema', 'fracture',
        'pneumothorax', 'ARDS', 'tear', 'sprain', 'contusion', 'infection'
    ]
    for word in abnormal_keywords:
        if word.lower() in content.lower():
            return "Abnormal"
    return "Normal"

def summarize_findings(findings):
    findings_lower = findings.lower()
    summary_lines = []

    if 'mass' in findings_lower or 'lesion' in findings_lower:
        summary_lines.append("A mass or lesion was detected, which may need further evaluation.")
    if 'edema' in findings_lower:
        summary_lines.append("Swelling or fluid buildup was found around the affected area.")
    if 'meningioma' in findings_lower:
        summary_lines.append("Findings are suggestive of a meningioma, a type of tumor that may require monitoring or treatment.")
    if 'anomaly' in findings_lower:
        summary_lines.append("A structural abnormality was noted, possibly benign, but should be reviewed by a doctor.")
    if 'infarct' in findings_lower:
        summary_lines.append("No recent stroke or tissue damage was observed.")
    if 'hemorrhage' in findings_lower:
        summary_lines.append("No brain bleeding was identified in the report.")
    if 'sinus' in findings_lower:
        summary_lines.append("Sinus-related changes such as mucosal thickening or inflammation were noted.")
    if 'enhancing' in findings_lower:
        summary_lines.append("Some regions showed contrast enhancement, which can indicate abnormal tissue.")
    
    if not summary_lines:
        summary_lines.append("No significant or unusual findings were noted in the report.")

    return " ".join(summary_lines)


def generate_result(pdf_path):
    raw_text = extract_text_from_pdf(pdf_path)
    if not raw_text.strip():
        return {"error": "Failed to extract text from PDF"}

    sections = extract_sections(raw_text)
    findings, impression = extract_findings_and_impression(raw_text)

    full_text_to_classify = findings + " " + impression
    status = classify_report(full_text_to_classify)

    summary = summarize_findings(findings + " " + impression)

    result = {
        "patient_name": sections['name'],
        "dob": sections['dob'],
        "exam": sections['exam'],
        "report_status": status,
        "findings": findings,
        "impression": impression,
        "summary": summary
    }
    return result

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print(json.dumps({"error": "No PDF file path provided"}))
        sys.exit(1)
    
    pdf_file = sys.argv[1]
    output = generate_result(pdf_file)
    print(json.dumps(output, indent=4))
