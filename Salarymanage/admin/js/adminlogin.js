/*
(function(){
    const fonts = ["cursive"];
    let captchaValue = "";

    function generateNumericString(length) {
        let result = "";
        const characters = "0123456789";
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result.padStart(6, "0");
    }

    function gencaptcha() {
        captchaValue = generateNumericString(5 + Math.floor(Math.random() * 5));
    }

    function setcaptcha() {
        let html = captchaValue.split("").map((char)=>{
            const rotate = -20 + Math.trunc(Math.random() * 30);
            const font = fonts[Math.trunc(Math.random() * fonts.length)];
            return `<span style="transform:rotate(${rotate}deg); font-family:${font};">${char}</span>`;
        }).join("");
        document.querySelector(".login_form #captcha .preview").innerHTML = html;
    }

    function initCaptcha() {
        document.querySelector(".login_form #captcha .captcha_refersh").addEventListener("click",function(){
            gencaptcha();
            setcaptcha();
        });

        gencaptcha();
        setcaptcha();
    }

    initCaptcha();

    document.querySelector(".login_form .form_button").addEventListener("click",function(){
        let inputcaptchavalue = document.querySelector(".login_form #captcha input").value;

        if (inputcaptchavalue === captchaValue) {
            document.getElementById("error_login").innerHTML = "";
            document.getElementById("error_input").value = "1";
        } else {
            // document.getElementById("error_login").innerHTML = "Invalid Captcha";
        }
    });
})();


*/




(function(){
    const fonts = ["cursive"];
    let captchaValue = "";

    function generateNumericString() {
        let result = "";
        const characters = "0123456789";
        for (let i = 0; i < 6; i++) {  // Generating exactly 6 digits
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }

    function gencaptcha() {
        captchaValue = generateNumericString(6);
    }

    function setcaptcha() {
        let html = captchaValue.split("").map((char)=>{
            const rotate = -20 + Math.trunc(Math.random() * 30);
            const font = fonts[Math.trunc(Math.random() * fonts.length)];
            return `<span style="transform:rotate(${rotate}deg); font-family:${font};">${char}</span>`;
        }).join("");
        document.querySelector(".login_form #captcha .preview").innerHTML = html;
    }

    function initCaptcha() {
        document.querySelector(".login_form #captcha .captcha_refersh").addEventListener("click",function(){
            gencaptcha();
            setcaptcha();
        });

        gencaptcha();
        setcaptcha();
    }

    initCaptcha();

    document.querySelector(".login_form .form_button").addEventListener("click",function(){
        let inputcaptchavalue = document.querySelector(".login_form #captcha input").value;

        if (inputcaptchavalue === captchaValue) {
            document.getElementById("error_login").innerHTML = "";
            document.getElementById("error_input").value = "1";
        } else {
            document.getElementById("error_login").innerHTML = "Invalid Captcha";
        }
    });
})();

