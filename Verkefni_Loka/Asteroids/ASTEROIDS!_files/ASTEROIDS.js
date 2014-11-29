// =========
// ASTEROIDS
// =========

"use strict";

/* jshint browser: true, devel: true, globalstrict: true */

var g_canvas = document.getElementById("myCanvas");
var g_ctx = g_canvas.getContext("2d");

/*
0        1         2         3         4         5         6         7         8
12345678901234567890123456789012345678901234567890123456789012345678901234567890
*/


// ====================
// CREATE INITIAL SHIPS
// ====================

function createInitialShips() {

    entityManager.generateShip({
        cx : 200,
        cy : 200
    });
    
}

// =============
// GATHER INPUTS
// =============

function gatherInputs() {
    // Nothing to do here!
    // The event handlers do everything we need for now.
}


// =================
// UPDATE SIMULATION
// =================

// We take a very layered approach here...
//
// The primary `update` routine handles generic stuff such as
// pausing, single-step, and time-handling.
//
// It then delegates the game-specific logic to `updateSimulation`


// GAME-SPECIFIC UPDATE LOGIC

function updateSimulation(du) {
    
    processDiagnostics();
    
    entityManager.update(du);

    // Prevent perpetual firing!
    eatKey(Ship.prototype.KEY_FIRE);
}

// GAME-SPECIFIC DIAGNOSTICS

var g_allowMixedActions = true;
var g_useGravity = false;
var g_useAveVel = true;
var g_renderSpatialDebug = false;

var KEY_MIXED   = keyCode('M');;
var KEY_GRAVITY = keyCode('G');
var KEY_AVE_VEL = keyCode('V');
var KEY_SPATIAL = keyCode('X');

var KEY_HALT  = keyCode('H');
var KEY_RESET = keyCode('R');

var KEY_0 = keyCode('0');


function processDiagnostics() {

    if (eatKey(KEY_MIXED))
        g_allowMixedActions = !g_allowMixedActions;

    if (eatKey(KEY_GRAVITY)) g_useGravity = !g_useGravity;

    if (eatKey(KEY_AVE_VEL)) g_useAveVel = !g_useAveVel;

    if (eatKey(KEY_SPATIAL)) g_renderSpatialDebug = !g_renderSpatialDebug;

    if (eatKey(KEY_HALT)) entityManager.haltShips();

    if (eatKey(KEY_RESET)) entityManager.resetShips();

    if (eatKey(KEY_0)) entityManager.toggleRocks();

}


// =================
// RENDER SIMULATION
// =================

// We take a very layered approach here...
//
// The primary `render` routine handles generic stuff such as
// the diagnostic toggles (including screen-clearing).
//
// It then delegates the game-specific logic to `gameRender`


// GAME-SPECIFIC RENDERING

function renderSimulation(ctx) {

    entityManager.render(ctx);
    g_score.render(ctx);

    if (g_renderSpatialDebug) spatialManager.render(ctx);
}


// =============
// PRELOAD STUFF
// =============

var g_images = {};

function requestPreloads() {

    var requiredImages = {
        ship   : "Asteroids/res/spaceship/ship.png",
        rock   : "Asteroids/res/rocks/rock.png",
        bullet : "Asteroids/res/bullets/bulletStuff.png",
        fireBlast: "Asteroids/res/effects/fireball_hit.png",
    };

    imagesPreload(requiredImages, g_images, preloadDone);
}

var g_sprites = {};

function preloadDone() {

    g_sprites.ship  = new Sprite(g_images.ship, g_images.ship.width, g_images.ship.height, 0, 0);
    g_sprites.rock  = new Sprite(g_images.rock, g_images.rock.width, g_images.rock.height, 0, 0);

    g_sprites.effects ={

    //Fireblast
        fireBlast: [
            new Sprite(g_images.fireBlast,98,87,24,23),
            new Sprite(g_images.fireBlast,101,94,142,18),
            new Sprite(g_images.fireBlast,107,99,266,14),
            new Sprite(g_images.fireBlast,108,102,8,137),
            new Sprite(g_images.fireBlast,110,105,135,135),
            new Sprite(g_images.fireBlast,112,105,262,135),
            new Sprite(g_images.fireBlast,111,105,7,259),
            new Sprite(g_images.fireBlast,108,104,138,259),
            new Sprite(g_images.fireBlast,107,102,268,259)
        ],
        blast: [
            new Sprite(g_images.bullet,21,22,3,65),
            new Sprite(g_images.bullet,21,41,26,56),
            new Sprite(g_images.bullet,28,49,50,52),
            new Sprite(g_images.bullet,32,49,81,50),
            new Sprite(g_images.bullet,34,50,116,52)
        ]
    };


    g_sprites.bullets ={

        //Bullet
        bulletType: [
        new Sprite(g_images.bullet,12,18,4,27),
        new Sprite(g_images.bullet,12,18,4,27),
        new Sprite(g_images.bullet,12,18,4,27),
        new Sprite(g_images.bullet,27,13,29,30),
        new Sprite(g_images.bullet,27,13,29,30),
        new Sprite(g_images.bullet,27,13,29,30),
        new Sprite(g_images.bullet,20,15,57,29),
        new Sprite(g_images.bullet,20,15,57,29),
        new Sprite(g_images.bullet,20,15,57,29),
        new Sprite(g_images.bullet,24,17,78,28),
        new Sprite(g_images.bullet,24,17,78,28),
        new Sprite(g_images.bullet,24,17,78,28)
        ]   
    };

    entityManager.init();
    createInitialShips();

    main.init();
}

// Kick it off
requestPreloads();