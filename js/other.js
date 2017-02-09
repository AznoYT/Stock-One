/**********************
*											*
* 	 File: other.js		*
*											*
**********************/

window.addEventListener('load', beg_func, false);
var COLS=50, ROWS= 17, SPACE=0, SNAKE=1, FOOD=2, LEFT=0, UP=1, RIGHT=2, DOWN=3, KEY_LEFT=37, KEY_UP=38, KEY_RIGHT=39, KEY_DOWN=40, KEY_SPC=32, KEY_ESC=27, canvas, context, keystate, frames, score, fr=0;

grid = {
	width: null, 
	height: null,
	grids: null,  
	init: function(d, c, r){
		this.width = c;
		this.height = r;
		this.grids = [];
		
		for(var x = 0; x < c; x++) {
			this.grids.push([]);
			
			for(var y = 0; y < r; y++) { this.grids[x].push(d); }
		}
	},
	set:function(val, x, y) { this.grids[x][y] = val; },
	get:function(x, y) { return this.grids[x][y]; }
}

snake = {
	direction:null,
	last:null,
	que:null,	 
	init:function(d, x, y) {
		this.direction = d;
		this.que = [];
		this.insert(x, y);
	},
	insert:function(x, y) {
		this.que.unshift({x:x, y:y});
		this.last = this.que[0];
	},
	remove:function() { return this.que.pop(); }
};

function setBlob() {
	var space = [];
	
	for(var x = 0;x < grid.width; x++) {
		for(var y = 0;y < grid.height; y++) {
			if(grid.get(x,y) == SPACE) { space.push({x:x, y:y}); }
		}
	}
	
	var rand = space[Math.round(Math.random() * (space.length - 1))];
	grid.set(FOOD, rand.x, rand.y);
	fr++;
}

function beg_func() {
	canvas = document.getElementById('canvas');
	canvas.width = COLS * 20;
	canvas.height = ROWS * 20;
	context = canvas.getContext("2d");
	frames = 0;
	keystate = {};
	document.addEventListener("keydown",function(e) { keystate[e.keyCode] = true; });
	document.addEventListener("keyup",function(e) { delete keystate[e.keyCode]; });
	document.body.onkeyup = function(e) {
    if(e.keyCode == KEY_SPC){
		document.getElementById('instr').innerHTML = "Appuyez sur la fleche du bas pour reveiller le serpent";
		init()
		infinity();
    }
	}
	document.onkeyup = function(e){
    if(e.keyCode == KEY_ESC){
		location.reload();
    }
	}
}

function init() {
	score = 0;fr = 0;
	grid.init(SPACE, COLS, ROWS);
	var snake_pos={x:0, y:0};
	snake.init(LEFT, snake_pos.x, snake_pos.y);
	grid.set(SNAKE, snake_pos.x, snake_pos.y);
	setBlob();
}

function infinity() {
	update();
	draw();
	window.requestAnimationFrame(infinity, canvas);
}

function update() {
	frames++;
	if(keystate[KEY_LEFT] && snake.direction !== RIGHT) { snake.direction = LEFT; }
	if(keystate[KEY_UP] && snake.direction !==DOWN) { snake.direction = UP; }
	if(keystate[KEY_RIGHT] && snake.direction !== LEFT) { snake.direction = RIGHT; }
	if(keystate[KEY_DOWN] && snake.direction !== UP) { snake.direction = DOWN; }
	if(frames%10 === 0) {
		var xcor = snake.last.x;
		var ycor = snake.last.y;
		switch(snake.direction) {
			case LEFT: xcor--; break;
			case UP: ycor--; break;
			case RIGHT: xcor++; break;
			case DOWN: ycor++; break;
		}
		if(xcor < 0 || xcor > grid.width-1 || ycor<0 || ycor > grid.height-1) { return init(); }
		if(grid.get(xcor,ycor) == SNAKE) { return init(); }
		if(grid.get(xcor,ycor) == FOOD) {
			score++;
			setBlob();
		}
		else {
			var end=snake.remove();
			grid.set(SPACE, end.x, end.y);
		}
		grid.set(SNAKE, xcor, ycor);
		snake.insert(xcor, ycor);
	}
	
}

function draw() {
	var tw = canvas.width / grid.width;
	var th = canvas.height / grid.height;
	
	for(var x = 0; x < grid.width; x++) {
		for(var y = 0; y < grid.height; y++) {
			switch(grid.get(x, y)) {
				case SPACE: context.fillStyle = '#000000'; break;
				case SNAKE: context.fillStyle = '#CCCCCC'; break;
				case FOOD: context.fillStyle = '#CCCCCC'; break;
			}
			context.fillRect(x * tw, y * th, tw, th);
		}
	}
	
	var x = document.getElementById('score');
	x.innerHTML = "Score: " + 5 * (fr - 1);
	var y = document.getElementById('food');
	y.innerHTML = "Pomme Manger: " + (fr - 1);
}

/******
* END *
******/

