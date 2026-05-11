document.addEventListener("DOMContentLoaded", function () {

    const toolbar = document.getElementById("nr-toolbar");

    const content = document.querySelector(".entry-content") ||
                    document.querySelector(".elementor-widget-theme-post-content") ||
                    document.querySelector(".jl_content");

    const paragraphs = document.querySelectorAll(".jl_content p");

    if (!content || !toolbar) return;

    let size = localStorage.getItem("nr_font") || 16;

    // Main content
    content.style.fontSize = size + "px";

    // Paragraphs
    paragraphs.forEach(p => {
        p.style.fontSize = size + "px";
    });

    const s = nrData;
    const isMobile = window.innerWidth <= 768;

    /* ================= STYLE ================= */

    toolbar.style.transition = `all ${s.anim_duration}s ease`;

    // Radius
    toolbar.style.borderRadius = isMobile ? s.m_radius + "px" : s.radius + "px";

    // Padding
    toolbar.style.paddingTop = (isMobile ? s.m_pad_top : s.pad_top) + "px";
    toolbar.style.paddingRight = (isMobile ? s.m_pad_right : s.pad_right) + "px";
    toolbar.style.paddingBottom = (isMobile ? s.m_pad_bottom : s.pad_bottom) + "px";
    toolbar.style.paddingLeft = (isMobile ? s.m_pad_left : s.pad_left) + "px";

    /* ================= COLORS ================= */

    toolbar.style.background = isMobile ? s.bg_mobile : s.bg_desktop;

    document.querySelectorAll("#nr-toolbar button").forEach(btn=>{
        btn.style.background = isMobile ? s.btn_bg_mobile : s.btn_bg_desktop;
        btn.style.color = isMobile ? s.btn_color_mobile : s.btn_color_desktop;
    });

    /* ================= BORDER ================= */

    if (s.border_enable) {
        toolbar.style.border = `${s.border_width}px solid ${s.border_color}`;
    }

    /* ================= POSITION ================= */

    toolbar.style.left = "auto";
    toolbar.style.right = "auto";
    toolbar.style.transform = "none";

    if (!isMobile) {
        toolbar.style.top = "40%";

        if (s.desktop_pos === "right") {
            toolbar.style.right = "15px";
        } else {
            toolbar.style.left = "15px";
        }

    } else {
        toolbar.style.bottom = "10px";
        toolbar.style.top = "auto";

        if (s.mobile_align === "center") {
            toolbar.style.left = "50%";
            toolbar.style.transform = "translateX(-50%)";
        }

        if (s.mobile_align === "left") {
            toolbar.style.left = "10px";
        }

        if (s.mobile_align === "right") {
            toolbar.style.right = "10px";
        }
    }

    /* ================= SCALE ================= */

    const toolbarScale = isMobile ? s.m_toolbar_scale : s.toolbar_scale;
    const buttonScale  = isMobile ? s.m_button_scale  : s.button_scale;

    toolbar.style.transform += ` scale(${toolbarScale})`;

    document.querySelectorAll("#nr-toolbar button").forEach(btn=>{
        btn.style.transform = `scale(${buttonScale})`;
        btn.style.fontSize = (14 * buttonScale) + "px";
        btn.style.height = (42 * buttonScale) + "px";
	btn.style.padding = "0 " + (10 * buttonScale) + "px";

	btn.style.display = "flex";
	btn.style.alignItems = "center";
	btn.style.justifyContent = "center";
	btn.style.lineHeight = "1";
    });

    /* ================= SCROLL ================= */

    window.addEventListener("scroll", () => {
        const rect = content.getBoundingClientRect();

        if (rect.top < window.innerHeight && rect.bottom > 0) {
            toolbar.classList.add("show");
        } else {
            toolbar.classList.remove("show");
        }
    });

    /* ================= BUTTON ACTION ================= */

    toolbar.addEventListener("click", (e) => {
        if (!e.target.dataset.action) return;

        const step = isMobile ? s.m_step : s.step;

        if (e.target.dataset.action === "increase") {
            size = parseInt(size) + parseInt(step);
        }

        if (e.target.dataset.action === "decrease") {
            size = parseInt(size) - parseInt(step);
        }

        if (e.target.dataset.action === "reset") {
            size = 16;
        }

        // Main content
        content.style.fontSize = size + "px";

        // Paragraphs
        paragraphs.forEach(p => {
            p.style.fontSize = size + "px";
        });

        localStorage.setItem("nr_font", size);
    });

});
