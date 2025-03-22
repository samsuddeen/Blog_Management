document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    const themeIcon = document.getElementById("themeIcon");
    const themeButtons = document.querySelectorAll("[data-bs-theme-value]");

    // Function to get the saved theme from localStorage
    const getTheme = () => localStorage.getItem("theme");

    // Function to determine the preferred theme
    const getPreferredTheme = () => {
        const storedTheme = getTheme();
        return storedTheme || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
    };

    // Function to apply theme to the document
    const setTheme = (theme) => {
        if (theme === "auto" && window.matchMedia("(prefers-color-scheme: dark)").matches) {
            document.documentElement.setAttribute("data-bs-theme", "dark");
        } else {
            document.documentElement.setAttribute("data-bs-theme", theme);
        }
    };

    // Function to update the active theme icon
    const updateThemeIcon = (theme) => {
        let iconClass;
        switch (theme) {
            case "light":
                iconClass = "bi bi-sun-fill";
                break;
            case "dark":
                iconClass = "bi bi-moon-stars-fill";
                break;
            default:
                iconClass = "bi bi-circle-half"; // Auto mode
        }
        themeIcon.className = iconClass; // Update the icon
    };

    // Function to update the UI based on the selected theme
    const updateThemeUI = (theme) => {
        themeButtons.forEach(button => {
            button.classList.remove("active");
            button.setAttribute("aria-pressed", "false");
        });

        const activeButton = document.querySelector(`[data-bs-theme-value="${theme}"]`);
        if (activeButton) {
            activeButton.classList.add("active");
            activeButton.setAttribute("aria-pressed", "true");
        }

        updateThemeIcon(theme);
    };

    // Set initial theme
    const preferredTheme = getPreferredTheme();
    setTheme(preferredTheme);
    updateThemeUI(preferredTheme);

    // Listen for changes in the system's dark mode preference
    window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", () => {
        const currentTheme = getTheme();
        if (currentTheme !== "light" && currentTheme !== "dark") {
            setTheme(getPreferredTheme());
        }
    });

    // Add event listeners to theme toggle buttons
    themeButtons.forEach(button => {
        button.addEventListener("click", () => {
            const selectedTheme = button.getAttribute("data-bs-theme-value");
            localStorage.setItem("theme", selectedTheme);
            setTheme(selectedTheme);
            updateThemeUI(selectedTheme);
        });
    });
});
