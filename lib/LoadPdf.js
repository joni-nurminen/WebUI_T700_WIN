function ChangePdf()
{
	var pdflist=document.getElementById("PdfList");
	document.getElementById("pdf_wiever").src = "lib/css/pdf/" + pdflist.options[pdflist.selectedIndex].text;
}