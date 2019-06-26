let meme;
let ctx;
let img;
let canvas;
let url;
let watermarkAvailable;

window.onload = function () {

    url = window.location.href;

    postData(url + '/getMeme').then(result => {
        if (result.hasOwnProperty('meme')) {
            watermarkAvailable = true;

            document.querySelector("#start-image").setAttribute("src", result.meme);
            initCanvas();

        }
        else {
            console.log(result);
        }
    });

    addTextLine();
    addTextLine();

    let templateImages = document.querySelectorAll(".modalDialog img");
    templateImages.forEach(element => element.addEventListener("click", e => loadTemplate(e.target)));
};

window.onclick = function (event) {
    let modal = document.querySelector("#openModal");
    if (event.target == modal) {
        document.querySelector("#closeModal").click();
    }
}

function createMeme() {
    return {
        texts: [createText("", 150, 70)]
    };
}

function createText(line, x, y) {
    return {
        line: line,
        size: 40,
        color: '#ffffff',
        fontFamily: 'Impact',
        isOutline: true,
        outlineWidth: 2,
        strokeStyle: '#000000',
        x: x,
        y: y
    };
}

function loadCustom(input) {

    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
            document.querySelector("#start-image").setAttribute("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        watermarkAvailable = false;
    }

    initCanvas();
}

function initCanvas() {
    canvas = document.querySelector("#meme-canvas");
    ctx = canvas.getContext("2d");

    img = document.querySelector("#start-image");

    img.onload = () => {
        meme.texts[1].y = canvas.height - 70;

        let hRatio = canvas.width / img.width;
        let vRatio = canvas.height / img.height;
        let ratio = Math.min(hRatio, vRatio);

        canvas.width = img.width * ratio;
        canvas.height = img.height * ratio;

        drawCanvas();
    };
    img.setAttribute('crossOrigin', 'anonymous');
}

function addTextLine() {
    if (meme == null) {
        meme = createMeme();
    }
    else {
        meme.texts.push(createText("", 150, 300));
    }
    let textsCount = Object.values(meme)[0].length;

    let textEditorsDiv = document.querySelector("#editors");
    let template = document.querySelector("#template");

    let textEditor = document.createElement("div");
    textEditor.className = "text-editor row";
    textEditor.innerHTML = template.innerHTML.replace(/\{(\w*?)\}/g, textsCount - 1);

    textEditorsDiv.appendChild(textEditor);
    if (textsCount > 2) drawCanvas();
}

function drawText(text) {
    ctx.font = text.size + "px " + text.fontFamily;
    ctx.fillStyle = text.color;

    if (text.isOutline) addOutline(text);
    ctx.fillText(text.line, text.x, text.y);
}

function addOutline(text) {
    ctx.strokeStyle = text.strokeStyle;
    ctx.lineWidth = text.outlineWidth;
    ctx.strokeText(text.line, text.x, text.y);
}

function drawCanvas() {

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(img, 0, 0, img.width, img.height,
        0, 0, canvas.width, canvas.height);

    if (!watermarkAvailable) {
        let watermark = "www12ed";

        ctx.fillStyle = 'rgba(0, 0, 0, 0.25)';
        ctx.font = '20px sans-serif';
        ctx.fillText(watermark, canvas.width - (watermark.length * 17), canvas.height - 20);
        ctx.fillStyle = 'rgba(255, 255, 255, 0.25)';
        ctx.fillText(watermark, canvas.width - (watermark.length * 17) - 2, canvas.height - 22);
    }

    meme.texts.forEach((text) => drawText(text));

}

function editText(input, textIndex) {
    let property = input.dataset.property;
    let value;

    value = input.type === "checkbox" ? input.checked : input.value;
    meme.texts[textIndex][property] = value;

    drawCanvas();
}

function loadTemplate(inputImg) {
    document.querySelector("#closeModal").click();
    document.querySelector("#start-image").setAttribute("src", inputImg.src);
    watermarkAvailable = false;
    initCanvas();
}

function downloadMeme(anchor) {
    let imgData = canvas.toDataURL("image/png");
    /* Change MIME type to trick the browser to download the file instead of displaying it */
    imgData = imgData.replace(/^data:image\/[^;]*/, 'data:application/octet-stream');

    /* In addition to <a>'s "download" attribute, you can define HTTP-style headers */
    imgData = imgData.replace(/^data:application\/octet-stream/, 'data:application/octet-stream;headers=Content-Disposition%3A%20attachment%3B%20filename=canvas.png');

    anchor.href = imgData;
}

document.getElementById('save').addEventListener('click', function (event) {
    event.preventDefault();
    let imageData = canvas.toDataURL("image/png");
    const data = { "image": imageData };

    postData(url + "/save", data).then(result => console.log(result));

});

document.getElementById('public').addEventListener('click', function (event) {
    // event.preventDefault();
    let visible = this.checked;
    const data = { "visible": visible };

    postData(url + "/public", data).then(result => console.log(result));

});

function postData(url = '', data = {}) {
    return fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(response => {
            return response;
        });
} 