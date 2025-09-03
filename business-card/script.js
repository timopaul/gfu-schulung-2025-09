
function multiply(a, b) {
    return a * b;
}

let multi = function (a, b) {
    return a * b;
}

function alertForExternalSite(event) {
    event.preventDefault();

    let confirmed = confirm("Möchten Sie wirklich die Seite business-card verlassen?");

    if (confirmed) {
        let url = event.target.href;
        window.open(url, '_blank');
    }
}

let moreSkills = ['JavaScript', 'HTML', 'CSS'];

document.addEventListener('DOMContentLoaded', function() {

    document.querySelector('.card .btn').addEventListener('click', alertForExternalSite);

    document.querySelector('.skills li:first-child').classList.add('highlight');

    let link = document.querySelector('.skills li.add-item');
    link.addEventListener('click', function(event) {
        event.preventDefault();

        let li = document.createElement('li');
        li.textContent = moreSkills.pop();

        let skillsList = document.querySelector('.skills');
        let children = skillsList.children;
        let lastChild = children[children.length - 1];
        skillsList.insertBefore(li, lastChild);

        if (0 === moreSkills.length) {
            link.style.display = 'none';
        }
    });

    let darkModeBtn = document.querySelector('#toggle-dark-mode');
    darkModeBtn.style.display = 'block';
    darkModeBtn.addEventListener('click', function() {
        document.body.classList.toggle('dark');

        let currentText = darkModeBtn.textContent;
        darkModeBtn.textContent = darkModeBtn.dataset.label;
        darkModeBtn.dataset.label = currentText;
    });

});


