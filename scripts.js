const translations = {
    kk: {
        systemLabel: 'Оқу жүйесі',
        loginPlaceholder: 'Логин',
        passwordPlaceholder: 'Құпия сөз',
        loginButton: 'кіру',
        resetPassword: 'Құпия сөзді өзгерту'
    },
    ru: {
        systemLabel: 'Учебная система',
        loginPlaceholder: 'Логин',
        passwordPlaceholder: 'Пароль',
        loginButton: 'войти',
        resetPassword: 'Изменить пароль'
    },
    en: {
        systemLabel: 'Learning System',
        loginPlaceholder: 'Login',
        passwordPlaceholder: 'Password',
        loginButton: 'login',
        resetPassword: 'Change password'
    }
};

function setLanguage(lang) {
    document.getElementById('system-label').innerText = translations[lang].systemLabel;
    document.getElementById('login-input').placeholder = translations[lang].loginPlaceholder;
    document.getElementById('password-input').placeholder = translations[lang].passwordPlaceholder;
    document.getElementById('login-button').innerText = translations[lang].loginButton;
    document.getElementById('reset-password').innerText = translations[lang].resetPassword;

    // Update active button and underline position
    const buttons = document.querySelectorAll('.lang-btn');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    const activeButton = document.querySelector(`.lang-btn[onclick="setLanguage('${lang}')"]`);
    activeButton.classList.add('active');

    const underline = document.getElementById('underline');
    underline.style.left = `${activeButton.offsetLeft}px`;
    underline.style.width = `${activeButton.offsetWidth}px`;
}

function updateDomain() {
    const loginInput = document.getElementById('login-input').value;
    const domainSpan = document.getElementById('domain');
    const isNumeric = /^\d+$/.test(loginInput);

    if (isNumeric) {
        domainSpan.textContent = '@stud.satbayev.university';
    } else {
        domainSpan.textContent = '@satbayev.university';
    }
}

$(document).ready(function() {
    $('body').on('click', '.password-control', function() {
        const passwordInput = $('#password-input');
        if (passwordInput.attr('type') === 'password') {
            $(this).addClass('view');
            passwordInput.attr('type', 'text');
        } else {
            $(this).removeClass('view');
            passwordInput.attr('type', 'password');
        }
        return false;
    });

    // Set default language to Russian and update underline position
    setLanguage('ru');
});


document.getElementById('periodForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const period = document.getElementById('period').value;
    
    fetch('generate_pdf.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `period=${period}`
    })
    .then(response => response.json())
    .then(data => {
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = `
            <p>Количество страниц: ${data.pages}</p>
            <p>Количество статей: ${data.articles}</p>
            <a href="${data.pdf_link}" target="_blank">Скачать PDF</a>
        `;
    });
});
