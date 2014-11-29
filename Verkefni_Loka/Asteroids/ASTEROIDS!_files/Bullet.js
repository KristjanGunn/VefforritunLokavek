// ======
// BULLET
// ======

"use strict";

/* jshint browser: true, devel: true, globalstrict: true */

/*
0        1         2         3         4         5         6         7         8
12345678901234567890123456789012345678901234567890123456789012345678901234567890
*/


// A generic contructor which accepts an arbitrary descriptor object
function Bullet(descr) {

    // Common inherited setup logic from Entity
    this.setup(descr);

    this._animFrame = 0;
    
    // Default sprite, if not otherwise specified
    this.sprite = this.sprite || g_sprites.bullets;
    this.activeSprite = this.activeSprite || g_sprites.bullets.bulletType[0];
    
/*
    // Diagnostics to check inheritance stuff
    this._bulletProperty = true;
    console.dir(this);
*/

}

Bullet.prototype = new Entity();
    
// Initial, inheritable, default values
Bullet.prototype.rotation = 0;
Bullet.prototype.cx = 200;
Bullet.prototype.cy = 200;
Bullet.prototype.velX = 1;
Bullet.prototype.velY = 1;

// Convert times from milliseconds to "nominal" time units.
Bullet.prototype.lifeSpan = 1500 / NOMINAL_UPDATE_INTERVAL;

Bullet.prototype.update = function (du) {


    spatialManager.unregister(this);

    this.pickSprite();

    if (this._isDeadNow) {
        return entityManager.KILL_ME_NOW;
    }

    this.lifeSpan -= du;
    if (this.lifeSpan < 0) return entityManager.KILL_ME_NOW;

    this.cx += this.velX * du;
    this.cy += this.velY * du;
    /*
    this.rotation += 1 * du;
    this.rotation = util.wrapRange(this.rotation,
                                   0, consts.FULL_CIRCLE);
    */
    this.wrapPosition();
    
    // Handle collisions
    //
    var hitEntity = this.findHitEntity();
    if (hitEntity) {
        if (hitEntity instanceof Ship) {
            newScore();
            g_score.score = 0;
        }
        var canTakeHit = hitEntity.takeBulletHit;
        if (canTakeHit) canTakeHit.call(hitEntity); 
        return entityManager.KILL_ME_NOW;
    }
    
    spatialManager.register(this);

};

Bullet.prototype.getRadius = function () {
    return 2;
};

Bullet.prototype.takeBulletHit = function () {
    this.kill();
};

Bullet.prototype.pickSprite = function() {

    var sprite_base = this.sprite;

    if (this._animFrame>=11) {
        this._animFrame = 0;
    }

    this._animFrame +=1;

    this.activeSprite = sprite_base.bulletType[this._animFrame];
}

Bullet.prototype.render = function (ctx) {

    var fadeThresh = Bullet.prototype.lifeSpan / 3;

    if (this.lifeSpan < fadeThresh) {
        ctx.globalAlpha = this.lifeSpan / fadeThresh;
    }

    var origScale = this.sprite.scale;
    this.sprite.scale = this._scale;
    this.activeSprite.drawCentredAt(ctx, this.cx, this.cy,this.rotation);

    ctx.globalAlpha = 1;
};
