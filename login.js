function toggleMode() {
    const wrapper = document.getElementById("wrapper");
    const login = document.getElementById("loginForm");
    const register = document.getElementById("registerForm");

    wrapper.classList.toggle("register-mode");

    if (wrapper.classList.contains("register-mode")) {
        login.style.display = "none";
        register.style.display = "block";
    } else {
        login.style.display = "block";
        register.style.display = "none";
    }
}