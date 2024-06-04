const translations = {
        kz: {
            home: "Басты бет",
            myStatus: "Менің мәртебем",
            myart:"Менің Мақалам",
            documentsInstructions: "Жетістік",
            scientificDB: "Журналдардағы мақалалар",
            scientificDB1:"Монографиялар",
            scientificDB2:"Диссертациялар",
            noNewNotifications: "Жаңа хабарламалар жоқ: 0",
            courseVideos: "Сіздің курстық бейнелеріңіз",
            logout: "Шығу",
            chooseFile: "Файл таңдау",
            save: "Сақтау",
            viewStatus: "Мәртебені қарау",
            editStatus: "Мәртебені өзгерту",
             department: "Кафедра",
            academicDegree: "Ғылыми дәрежесі",
            academicTitle: "Ғылыми атағы",
            position: "Лауазымы",
            education: "Білімі",
            experience: "Жұмыс өтілі мен тәжірибесі",
            contacts: "Байланыстар",
            publicationsProjects: "Жарияланымдар және жобалар",
            editProfile: "Профильді өңдеу"
        },
        ru: {
            home: "Главная",
            myStatus: "Мой Статус",
            myart:"Моя Статья",
            documentsInstructions: "Достижение",
            scientificDB: "Статьи в журналах",
            scientificDB1:"Монографии",
            scientificDB2:"Диссертации",
            noNewNotifications: "У Вас нет новых уведомлений: 0",
            courseVideos: "Ваши видео по курсу",
            logout: "Выход",
            chooseFile: "Выбрать файл",
            save: "Сохранить",
            viewStatus: "Просмотр Статуса",
            editStatus: "Изменить статуса",
             department: "Кафедра",
            academicDegree: "Ученая степень",
            academicTitle: "Ученое звание",
            position: "Должность",
            education: "Образование",
            experience: "Стаж и опыт работы",
            contacts: "Контакты",
            publicationsProjects: "Публикации и проекты",
            editProfile: "Редактировать профиль"
        },
        en: {
            home: "Home",
            myStatus: "My Status",
            myart:"My Article",
            documentsInstructions: "Achievement",
            scientificDB: "Articles in magazines",
            scientificDB1:"Monographs",
            scientificDB2:"Dissertations",
            noNewNotifications: "You have no new notifications: 0",
            courseVideos: "Your Course Videos",
            logout: "Logout",
            chooseFile: "Choose File",
            save: "Save",
            viewStatus: "View Status",
            editStatus: "Edit Status",
             department: "Department",
            academicDegree: "Academic Degree",
            academicTitle: "Academic Title",
            position: "Position",
            education: "Education",
            experience: "Experience",
            contacts: "Contacts",
            publicationsProjects: "Publications and Projects",
            editProfile: "Edit Profile"
        }
    };

    function setLanguage(lang) {
        const elements = document.querySelectorAll('[data-key]');
        elements.forEach(element => {
            const key = element.getAttribute('data-key');
            element.textContent = translations[lang][key];
        });
    }

    // Set default language to Russian
    document.addEventListener('DOMContentLoaded', () => {
        setLanguage('ru');
    });

    function playVideo() {
        var video = document.getElementById("profile-video");
        if (video.paused) {
            video.play(); 
        } else {
            video.pause();
        }
    }

    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdown-menu");
        dropdownMenu.classList.toggle("show");
    }

    function addZero(i) {
        return (i < 10) ? "0" + i : i;
    }

function getCurrentDateTime() {
    var today = new Date();
    var date = today.getFullYear()+'-'+addZero(today.getMonth()+1)+'-'+addZero(today.getDate());
    var time = addZero(today.getHours()) + ":" + addZero(today.getMinutes()) + ":" + addZero(today.getSeconds());
    return date + ' ' + time;
}

function updateDateTime() {
    var dateTimeElement = document.getElementById('current-date-time');
    if (dateTimeElement) {
        dateTimeElement.textContent = getCurrentDateTime();
    }
}

updateDateTime();
setInterval(updateDateTime, 1000);

function toggleDropdown() {
    console.log("Dropdown toggled"); // Check if the function is called
    document.getElementById("dropdown-menu").classList.toggle("show");
}

// Close dropdown if clicked outside
window.onclick = function(event) {
    console.log("Clicked outside"); // Check if the event handler is triggered
    if (!event.target.matches('.dropdown-toggle')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

window.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('file-input').addEventListener('change', function() {
        var fileName = this.files[0].name;
        var label = document.querySelector('.file-label');
        label.textContent = 'Файл выбран: ' + fileName;
    });
});
xx


