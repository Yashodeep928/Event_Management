// GSAP + Smooth Scrolling Script
document.addEventListener("DOMContentLoaded", () => {
    // Sidebar Toggle
    const toggleSidebar = document.querySelector("#toggleSidebar");
    const sidebar = document.querySelector(".sidebar");
    const mainContent = document.querySelector(".main-content");
  
    toggleSidebar.addEventListener("click", () => {
      sidebar.classList.toggle("collapsed");
      mainContent.classList.toggle("collapsed");
    });
  
    // GSAP Animations
    gsap.registerPlugin(ScrollTrigger);
  
    // Fade-in effect for cards
    gsap.from(".card", {
      opacity: 0,
      y: 50,
      duration: 1,
      stagger: 0.2,
      scrollTrigger: {
        trigger: ".card",
        start: "top 80%",
      },
    });
  
    // Header Animation
    gsap.from(".dashboard-header", {
      opacity: 0,
      y: -30,
      duration: 1,
      delay: 0.5,
    });
  
    // Section Scroll Animations
    gsap.utils.toArray(".section").forEach((section) => {
      gsap.from(section, {
        scrollTrigger: {
          trigger: section,
          start: "top 80%",
        },
        opacity: 0,
        y: 50,
        duration: 1,
      });
    });
  });
  