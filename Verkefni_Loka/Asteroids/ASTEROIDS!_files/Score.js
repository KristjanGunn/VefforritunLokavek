var g_score =  {

	cx : 0,
	cy : 0,
	margin: 10,
	marginHS: 40,
	marginINSTR: 440,
	score: 0
}

g_score.render = function(ctx) {

	ctx.fillStyle = "white";
	ctx.beginPath();
	ctx.font="bold 20px Audiowide";
	ctx.fillText("SCORE: " + this.score, this.margin, g_canvas.height-this.marginHS);
	ctx.closePath();

	ctx.fillStyle = "white";
	ctx.beginPath();
	ctx.font="bold 20px Audiowide";
	ctx.fillText("YOUR HIGH SCORE: " + localStorage.getItem("score"), this.margin, g_canvas.height-this.margin);
	ctx.closePath();

	ctx.fillStyle = "white";
	ctx.beginPath();
	ctx.font="bold 20px Audiowide";
	ctx.fillText("FLY WITH W,A,S,D AND SHOOT WITH Q", g_canvas.width-this.marginINSTR, g_canvas.height-this.margin);
	ctx.closePath();
}

function newScore() {
	if (typeof(Storage) != "undefined") {
            // Store
            if (g_score.score>localStorage.getItem("score")) {
	            localStorage.setItem("score", g_score.score);
    		}
    } 
}
