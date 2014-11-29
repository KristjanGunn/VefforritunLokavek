var g_score =  {

	cx : 0,
	cy : 0,
	width: 1000,
	margin: 10,
	score: 0,
	height: 450
}

g_score.render = function(ctx) {

	ctx.fillStyle = "white";
	ctx.beginPath();
	ctx.font="bold 20px Audiowide";
	ctx.fillText("SCORE: " + this.score, this.margin, g_canvas.height-this.margin*4);
	ctx.closePath();

	ctx.fillStyle = "white";
	ctx.beginPath();
	ctx.font="bold 20px Audiowide";
	ctx.fillText("SCORE: " + localStorage.getItem("score"), this.margin, g_canvas.height-this.margin);
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
