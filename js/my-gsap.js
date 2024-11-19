/* Hero */

let heroButton = gsap.timeline({repeat: -1, yoyo:true});
heroButton.from(".cta", { y: "-0.5rem", duration: 0.8, ease: "power1.inOut" }); 

let heroText = gsap.timeline();
heroText.from(".cta", { opacity: 0, y: "6rem", duration: 0.8, onComplete: heroButton.play() }); 