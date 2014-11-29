"use strict";
/*
    Effect constructor
    Takes in cx,cy and type
    Creates an effect in cx,cy of a specified type
*/
function Effect(cx,cy, rotation, type) {
    //The sprites
    this.sprite = g_sprites.effects;
    //Determine type of effect
    switch(type){
        case "FIREBLAST":
            this.activeSprite = this.sprite.fireBlast;
            this.scale = 1;
            break;
        case "BLAST":
            this.activeSprite = this.sprite.blast;
            this.scale = 1;
            break;
    }
    //Initialise values
    this.type = type;
    this.width = this.activeSprite[0].width*this.scale;
    this.height = this.activeSprite[0].height*this.scale;
    this.cx = cx;
    this.cy = cy;
    this.rotation = rotation;
    this.animFrame = 0;
    this.animTicker = 0;
    this.animTickRate = 1;
    this.shouldDraw=true;
};

//Create entity
Effect.prototype = new Entity();
/*
    Render the effect
*/
Effect.prototype.render = function(ctx){

    //save the original scale
    var origScale = this.activeSprite[this.animFrame].scale;
    // pass my scale into the sprite, for drawing
    this.activeSprite[this.animFrame].scale = this.scale;

    //Rendering for fireblast
    if(this.type === "FIREBLAST" || this.type ==="BLAST") {
        this.activeSprite[this.animFrame].drawCentredAt(ctx,this.cx,this.cy, this.rotation);
    }

    this.activeSprite[this.animFrame].scale = origScale;
};

/*
    Updates the effects
*/
Effect.prototype.update = function(du){
    //Check for death
    if(this._isDeadNow){return entityManager.KILL_ME_NOW;}
    //Desides when to change sprites
    if(this.animTicker < this.animTickRate){
        this.animTicker += du;
    }
    else {
        this.changeSprite();
        this.animTicker = 0;
    }
}

/*
    Changes sprite
*/
Effect.prototype.changeSprite = function(){
    if(this.animFrame < this.activeSprite.length-1){
        this.animFrame +=1;
    }
    else {
        this.kill();
    }
}

