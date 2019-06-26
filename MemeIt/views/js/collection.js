let url;

window.onload = () => {
    url = window.location.href;
    postData(url + '/getAllMemes').then(result => {
        createMemes(result);
    });


};

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

function createMemes(topicData) {
    let topicIds = topicData.map((entry) => entry.id);
    let topicTitles = topicData.map((entry) => entry.title);
    let topicMemes = topicData.map((entry) => entry.meme);

    postData(url + '/getUsers', topicIds).then(result => {
        createTemplate(topicTitles, topicMemes, result);
    });

}

function createTemplate(topicTitles, topicMemes, userData) {
    let main = document.querySelector("#memes");
    let template = document.querySelector("#meme-template");

    for (let i = 0; i < topicTitles.length; i++) {
        let divResponsive = document.createElement("div");
        divResponsive.classList.add("responsive");

        let divGallery = document.createElement("div");
        divGallery.classList.add("gallery");

        let anchor = document.createElement("a");
        anchor.setAttribute("target", "_blank");

        fetch(topicMemes[i])
            .then(result => result.blob())
            .then(blob => {
                let url = URL.createObjectURL(blob);
                anchor.setAttribute("href", url);
            });

        let img = document.createElement("img");
        img.setAttribute("src", topicMemes[i]);
        img.setAttribute("alt", "Meme");
        img.setAttribute("width", "600");
        img.setAttribute("height", "400");

        anchor.appendChild(img);
        divGallery.appendChild(anchor);

        let divDescription = document.createElement("div");
        divDescription.classList.add("description");

        let p = document.createElement("p");
        p.innerHTML = topicTitles[i];

        let span = document.createElement("span");
        span.innerHTML = userData[i].name;

        divDescription.appendChild(p);
        divDescription.appendChild(span);

        divGallery.appendChild(divDescription);
        divResponsive.appendChild(divGallery);

        main.appendChild(divResponsive);

        // <div class="responsive">
        //     <div class="gallery">
        //         <a target="_blank" href="">
        //             <img src="image.jpg" alt="Meme" width="600" height="400">
        //         </a>
        //         <div class="description">
        //             <p></p>
        //             <span></span>
        //         </div>
        //     </div>
        // </div>
    }

}