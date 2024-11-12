/* Hero */

let heroButton = gsap.timeline({repeat: -1, yoyo:true});
heroButton.from(".cta", { y: "-0.5rem", duration: 0.8, ease: "power1.inOut" }); 

let heroText = gsap.timeline();
heroText.from(".block-intro-content.first", { opacity: 0, y: "6rem", duration: 0.8 }); 
heroText.from(".cta", { opacity: 0, y: "6rem", duration: 0.8, onComplete: heroButton.play() }); 



/* Why We Exist */

let scrollTl = gsap.timeline({
    scrollTrigger:{
        trigger:'#why-we-exist',
        start:"20% center",
        end: "bottom bottom",
        markers: false,
    /*     scrub:true, */
        toogleActions: "none play none resume"
    }
});

scrollTl.from(".box-disease", { opacity: 0, stagger: { amount:1.5 }, duration: 1,}, "<0.5");

/* What We Do */

let CellsTl = gsap.timeline({
    scrollTrigger:{
        trigger:'.what-we-do',
        start:"top center",
        end: "bottom bottom",
        markers: false,
    /*     scrub:true, */
        toogleActions: "none play none resume"
    }
});

CellsTl.from(".image-cells", { opacity: 0, y: "-6rem", duration: 0.8 }); 



/* Diagnostics */

let DiagnosticsTl = gsap.timeline({
    scrollTrigger:{
        trigger:'.diagnostics',
        start:"top center",
        end: "bottom bottom",
        markers: false,
    /*     scrub:true, */
        toogleActions: "none play none resume"
    }
});

DiagnosticsTl.from(".diagnostics .separador", { opacity: 0, y: "6rem", duration: 0.8 });
DiagnosticsTl.from(".item-reason", { opacity: 0, stagger: { amount:2 }, duration: 1,}, "<0.5");



/* Our Impact */

let scrollOurImpactTl = gsap.timeline({
    scrollTrigger:{
        trigger:'.our-impact',
        start:"top center",
        end: "bottom bottom",
        markers: false,
    /*     scrub:true, */
        toogleActions: "none play none resume"
    }
});

scrollOurImpactTl.from(".second", { opacity:0, scale: 0.6, duration: 0.8,});

let videoImpact = gsap.timeline({repeat: -1, yoyo:true});
videoImpact.from(".btn.play", { y: "-0.5rem", duration: 0.8, ease: "power1.inOut" }); 


/* Our Team */

let scrollOurTeamTl = gsap.timeline({
    scrollTrigger:{
        trigger:'#our-team',
        start:"20% center",
        end: "bottom bottom",
        markers: false,
    /*     scrub:true, */
        toogleActions: "none play none resume"
    }
});

scrollOurTeamTl.from(".item-member", { opacity: 0, stagger: { amount:1.5 }, duration: 0.8,}, "<0.5");  


/* Careers */

let scrollCareersTl = gsap.timeline({
    scrollTrigger:{
        trigger:'.careers',
        start:"20% center",
        end: "bottom bottom",
        markers: false,
    /*     scrub:true, */
        toogleActions: "none play none resume"
    }
});

scrollCareersTl.from(".item-careers", { opacity: 0, stagger: { amount:1.5 }, duration: 1,}, "<0.5");


/* Contact */

let contactTl = gsap.timeline({
    scrollTrigger:{
        trigger:'#contact',
        start:"20% center",
        end: "bottom bottom",
        markers: false,
    /*     scrub:true, */
        toogleActions: "none play none resume"
    }
});

contactTl.from(".map", { opacity: 0, y: "6rem", duration: 0.8, /* onComplete: heroButton.play() */ });


