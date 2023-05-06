console.log("js file");

function resizeCanvas() {
    var oldContent = signaturePad.toData();
    var ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
    signaturePad.clear();
    signaturePad.fromData(oldContent);
}

function clearpad() {
    signaturePad.clear();
}
function submitForm() {
    //Unterschrift in verstecktes Feld übernehmen
    console.log(signaturePad.toDataURL());
    document.getElementById("signature").value = signaturePad.toDataURL();
}

var wrapper = document.getElementById("signature-pad"),
    canvas = wrapper.querySelector("canvas"),
    signaturePad;

var signaturePad = new SignaturePad(canvas);
signaturePad.minWidth = 2;
signaturePad.maxWidth = 3;
signaturePad.penColor = "rgb(10, 75, 10)";
// signaturePad.minWidth = 1; //minimale Breite des Stiftes
// signaturePad.maxWidth = 5; //maximale Breite des Stiftes
// signaturePad.penColor = "#000000"; //Stiftfarbe
signaturePad.backgroundColor = "#FFFFFF"; //Hintergrundfarbe
window.onresize = resizeCanvas;
resizeCanvas();
