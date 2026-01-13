


document.addEventListener("DOMContentLoaded", (event) => {
    gsap.registerPlugin(ScrollTrigger);
    gsap.utils.toArray(".box").forEach((box, index) => {
        gsap.fromTo(box,
            {
                opacity: 0,
                x: -200
            },
            {
                opacity: 1,
                x: 200,
                duration: 1.5,
                delay: 0.4,
                ease: "power4.inOut",
                scrollTrigger: {
                    trigger: box,
                    toggleActions: "play none none reverse"
                }
            }
        );
    });

    function animationscrollup(classname, y_bettween, y_delay) {
        gsap.utils.toArray(classname).forEach((animationscrollup) => {
            gsap.fromTo(animationscrollup,
                {
                    opacity: 0,
                    y: y_bettween

                },
                {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    delay: y_delay,
                    ease: "power3.inOut",
                    scrollTrigger: {
                        trigger: animationscrollup,
                    }
                }
            );
        });
    }
    // animationscrollup('.animationscroll-up',100,0.2);

    gsap.fromTo('.navbar',
        {
            opacity: 0,
        },
        {
            opacity: 1,
            duration: 0.8,
            delay: 0.5,
            ease: "power3.inOut",
        }
    );
    gsap.fromTo('.animation-zompup',
        {
            opacity: 0,
        },
        {
            opacity: 1,
            duration: 0.8,
            delay: 0.8,
            ease: "power3.inOut",
        }
    );
    gsap.fromTo('.animation-zompup2',
        {
            opacity: 0,
        },
        {
            opacity: 1,
            duration: 0.8,
            delay: 1,
            ease: "power3.inOut",
        }
    );

    gsap.fromTo('.animation-up',
        {
            opacity: 0,
            y: 100,
        },
        {
            opacity: 1,
            y: 0,
            duration: 1.6,
            delay: 0.8,
            ease: "power3.inOut",
        }
    );
    gsap.fromTo('.animation-down',
        {
            y: -100,
            opacity: 0,
        },
        {
            opacity: 1,
            y: 0,
            duration: 1.6,
            delay: 0.8,
            ease: "power3.inOut",
        }
    );

    function animationleft(classname,x_bettween,x_delay){
        gsap.fromTo(classname,
            {
                x:x_bettween,
                opacity: 0,
            },
            {
                opacity: 1,
                x:0,
                duration: 1.6,
                delay:x_delay,
                ease: "power3.inOut",
                scrollTrigger: {
                    trigger: classname,
                }
            }
        );
    }
    function zompup(classname,y_bettween,x_delay){
        gsap.fromTo(classname,
            {
                y: y_bettween,
                opacity: 0,
            },
            {
                opacity: 1,
                y: 0,
                duration: 1.6,
                delay: x_delay,
                ease: "power3.inOut",
                scrollTrigger: {
                    trigger: classname,
                }
            }
        );
    }
    function animationright(classname,x_bettween,x_delay){
        gsap.fromTo(classname,
            {
                x: x_bettween,
                opacity: 0,
            },
            {
                opacity: 1,
                x: 0,
                duration: 1.6,
                delay: x_delay,
                ease: "power3.inOut",
                scrollTrigger: {
                    trigger: classname,
                }
            }
        );
    }

    gsap.fromTo('.animation-title',
        {
            opacity: 0,
            // x: -50,
        },
        {
            opacity: 1,
            // x: 0,
            duration: 0.8,
            delay: 1,
            ease: "power3.inOut",
            stagger: 0.08,
        }
    );

    gsap.fromTo('.animation-description',
        {
            opacity: 0,
        },
        {
            opacity: 1,
            duration: 0.8,
            delay: 1.5,
            ease: "power3.inOut",
            stagger: 0.08,
        }
    );

    //search animation
     animationscrollup('.searchanimation-up',500,0.5)


    animationscrollup('.animationscroll-up-1', 100, 0.2);
    animationscrollup('.animationscroll-up-2', 100, 0.3);
    animationscrollup('.animationscroll-up-3', 100, 0.4);
    animationscrollup('.animationscroll-up-4', 100, 0.5);
    animationscrollup('.animationscroll-up-5', 100, 0.6);
    animationscrollup('.animationscroll-up-6', 100, 0.7);
    animationscrollup('.animationscroll-up-7', 100, 0.8);
    animationscrollup('.animationscroll-up-8', 100, 0.9);

    animationscrollup('.animationscroll2-up-1', 100, 0.2);
    animationscrollup('.animationscroll2-up-2', 100, 0.3);
    animationscrollup('.animationscroll2-up-3', 100, 0.4);
    animationscrollup('.animationscroll2-up-4', 100, 0.5);

    animationscrollup('.animationscroll3-up-1', 100, 0.2);
    animationscrollup('.animationscroll3-up-2', 100, 0.3);
    animationscrollup('.animationscroll3-up-3', 100, 0.4);
    animationscrollup('.animationscroll3-up-4', 100, 0.5);
    animationscrollup('.animationscroll3-up-5', 100, 0.5);

    animationscrollup('.animationscroll4-up-1', 100, 0.2);
    animationscrollup('.animationscroll4-up-2', 100, 0.3);
    animationscrollup('.animationscroll4-up-3', 100, 0.4);
    animationscrollup('.animationscroll4-up-4', 100, 0.5);
    animationscrollup('.animationscroll4-up-5', 100, 0.5);

    animationscrollup('.animationscroll5-up-1', 100, 0.2);
    animationscrollup('.animationscroll5-up-2', 100, 0.3);
    animationscrollup('.animationscroll5-up-3', 100, 0.4);
    animationscrollup('.animationscroll5-up-4', 100, 0.5);
    animationscrollup('.animationscroll5-up-5', 100, 0.5);

    animationleft('.animationleft-1',-50,0.5);
    animationleft('.animationleft-2',-50,0.2);
    animationleft('.animationleft-3',-50,0.2);
    animationright('.animationright-1',50,0.5);
    animationright('.animationright-2',50,0.2);
    animationright('.animationright-3',50,0.2);
    //title aniamtion left
    animationleft('.animationleft-title-1',-50,0.2);
    animationleft('.animationleft-title-2',-50,0.2);
    animationleft('.animationleft-title-3',-50,0.2);
     //title aniamtion right
    animationright('.animationright-title-1',50,0.2);
    animationright('.animationright-title-2',50,0.2);
    //animation live title
    animationleft('.animationleft-livetitle-1',-100,0.8);
    animationleft('.animationleft-livedescription-1',-100,1.2);

    animationright('.animationright-livephoto-1',100,1.4);
    //end animation live
});













