const accountBtn = document.getElementById("accountBtn");
const popup = document.getElementById("accountPopup");

accountBtn.addEventListener("click", () => {
    popup.classList.toggle("account-hidden");
});

function logout() {
    window.location.href = "route/logOut.php";
}
