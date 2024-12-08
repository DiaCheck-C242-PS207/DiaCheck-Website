// Dark Mode
const darkModeToggle = document.querySelector('.dark-mode-toggle');
const darkModeIcon = darkModeToggle.querySelector('i');

// Cek localStorage untuk status mode gelap
if (localStorage.getItem('dark-mode') === 'enabled') {
    document.body.classList.add('dark');
    darkModeIcon.className = 'bx bx-moon';
}

darkModeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark');

    if (document.body.classList.contains('dark')) {
        // Simpan status ke localStorage
        localStorage.setItem('dark-mode', 'enabled');
        darkModeIcon.className = 'bx bx-moon';
    } else {
        // Hapus status dari localStorage
        localStorage.setItem('dark-mode', 'disabled');
        darkModeIcon.className = 'bx bx-sun';
    }
});
// Dark Mode End



// Navbar
try {
    const navbar = document.querySelector(".navbar");
    const navbar2 = document.querySelector(".navbar-detail");
    const classList = ["shadow-sm", "border-bottom", "border-secondary", "bg-navbar"];

    if (navbar || navbar2) {
        const handleScroll = () => {
            const action = window.pageYOffset > 0.1 ? 'add' : 'remove';
            if (navbar) navbar.classList[action](...classList);
            if (navbar2) navbar2.classList[action](...classList);
        };

        window.addEventListener("scroll", handleScroll);
    }
} catch (error) {
    console.log("Fitur navbar tidak ditemukan!");
}
// Navbar End



// Image Preview
const previewAvatar = document.getElementById('img-avatar');
const inputAvatar = document.getElementById('upload-foto');

try {
    inputAvatar.onchange = (e) => {
        if (inputAvatar.files && inputAvatar.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewAvatar.src = e.target.result;
            };
            reader.readAsDataURL(inputAvatar.files[0]);
        }
    };
} catch (error) {
    console.log('Image preview not found!');
}
// Image Preview End



// Validasi Input
const editUsernameInput = document.getElementById('edit-username');
const simpanButton = document.getElementById('save-edit-profile-btn');
const errorMessage = document.getElementById('edit-profile-error-message-username');

try {
    editUsernameInput.addEventListener('input', function() {
        if (editUsernameInput.value.length > 30) {
            editUsernameInput.classList.add('is-invalid');
            simpanButton.classList.add('disabled');
            errorMessage.style.display = 'block';
            errorMessage.innerText = "too long! max 20 characters";
        } else {
            editUsernameInput.classList.remove('is-invalid');
            simpanButton.classList.remove('disabled');
            errorMessage.style.display = 'none';
        }
    });
} catch (error) {
    console.log("Username edit validation not found!");
}
// Validasi Input End



// Back to Top
const iconBackToTop = document.querySelector(".icon-back-to-top");

try {
    if (iconBackToTop) {
        window.addEventListener("scroll", () => {
            if(window.pageYOffset > 100) {
                iconBackToTop.classList.add("active");
            }
            else {
                iconBackToTop.classList.remove("active");
            }
        });
    }
} catch (error) {
    console.log('Back to top not found!');
}
// Back to Top End



// Deskripsi See All
function viewDetails(id) {
    var detailsElement = document.getElementById("view-details-" + id);
    var detailsIconDown = document.getElementById("icon-down-" + id);
    var detailsIconUp = document.getElementById("icon-up-" + id);

    detailsElement.classList.toggle("active");

    if (detailsElement.classList.contains("active")) {
        detailsIconDown.style.display = "none";
        detailsIconUp.style.display = "block";
    } else {
        detailsIconDown.style.display = "block";
        detailsIconUp.style.display = "none";
    }
}
// Deskripsi See All End


// Copy Link
function copyLink(id) {
    const linkInput = document.getElementById("copy-link-" + id);
    const linkText = document.getElementById("copy-link-text-" + id);
    const linkBtn = document.getElementById("copy-link-btn-" + id);

    navigator.clipboard.writeText(linkInput.value).then(() => {
        linkText.innerHTML = '<i class="fa-solid fa-check text-dark"></i>';
        linkBtn.style.backgroundColor = "transparent";
        linkText.style.color = "#000";

        setTimeout(() => {
            linkText.innerHTML = '<i class="fa-solid fa-copy"></i>';
            linkBtn.style.backgroundColor = "#FE5E49";
            linkText.style.color = "#fff";
        }, 5000);
    }).catch(error => {
        console.error('Fitur copy link tidak ditemukan!', error);
    });
}

function shareToFacebook(url) {
    const facebookShareLink = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
    window.open(facebookShareLink, '_blank');
}

function shareToX(url, title) {
    const XShareLink = `https://x.com/intent/post?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
    window.open(XShareLink, '_blank');
}

function shareToEmail(url, title) {
    const emailShareLink = `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent(url)}`;
    window.location.href = emailShareLink;
}
// Copy Link End