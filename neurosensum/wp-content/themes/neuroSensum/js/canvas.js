		

		let canvas;
		let ctx;
		let w, h;
		let m;
		let simplex;
		let ticker;
		let mx, my;

		function setup() {
		  canvas = document.querySelector("#canvas");
		  ctx = canvas.getContext("2d");
		  reset();
		  window.addEventListener("resize", reset);
		  // canvas.addEventListener("mousemove", mousemove);
		}

	

		function reset() {
		  simplex = new SimplexNoise();
		  ticker = 0;
		  w = canvas.width = window.innerWidth;
		  h = canvas.height = window.innerHeight;
		  m = Math.min(w, h);
		  mx = w / 2.8;
		  my = h / 2.8;
		}

		function mousemove(event) {
		  mx = event.clientX /2.8;
		  my = event.clientY /2.8;
		}

		function draw() {
		  ticker += 0.01;
		  requestAnimationFrame(draw);
		  ctx.fillStyle = "#cc3e17";
		  ctx.fillRect(0, 0, w, h);
		  ctx.strokeStyle = "#fff";
		  for(let i = 10; i < m / 2.8 - 40; i += 5.1) {
		    drawCircle(i);
		  }
		}



		function drawCircle(r) {
		  ctx.beginPath();
		  let point, x, y;
		  for(let angle = 0; angle < Math.PI * 2; angle += 0.02) {
		    point = calcPoint(angle, r);
		    x = point[0];
		    y = point[1];
		    ctx.lineTo(x, y);
		  }
		  ctx.stroke();
		}

		function calcPoint(angle, r) {
		  let noiseFactor = 10;
		  let zoom = my / h * 200;
		  let x =  w / 2;
		  let y =  w / 2;
		  n = (simplex.noise3D(x / zoom, y / zoom, ticker)) * noiseFactor;
		  x = Math.cos(angle) * (r + n) + w / 2;
		  y = Math.sin(angle) * (r + n) + h / 2;
		  return [x, y];
		}

		setup();
		draw();






    let canvas1;
    let ctx1;
    let w1, h1;
    let m1;
    let simplex1;
    let ticker1;
    let mx1, my1;

    function setup1() {
      canvas1 = document.querySelector("#canvas1");
      ctx1 = canvas1.getContext("2d");
      reset1();
      window.addEventListener("resize", reset1);
      // canvas.addEventListener("mousemove", mousemove);
    }

  

    function reset1() {
      simplex1 = new SimplexNoise();
      ticker1 = 0;
      w1 = canvas1.width = window.innerWidth;
      h1 = canvas1.height = window.innerHeight;
      m1 = Math.min(w1, h1);
      mx1 = w1 / 2.8;
      my1 = h1 / 2.8;
    }

    function mousemove1(event) {
      mx1 = event.clientX /2.8;
      my1 = event.clientY /2.8;
    }

    function draw1() {
      ticker1 += 0.01;
      requestAnimationFrame(draw1);
      ctx1.fillStyle = "#fff";
      ctx1.fillRect(0, 0, w1, h1);
      ctx1.strokeStyle = "#cc3e17";
      for(let i = 10; i < m1 / 2.8 - 40; i += 5.1) {
        drawCircle1(i);
      }
    }



    function drawCircle1(r1) {
      ctx1.beginPath();
      let point1, x1, y1;
      for(let angle1 = 0; angle1 < Math.PI * 2; angle1 += 0.02) {
        point1 = calcPoint(angle1, r1);
        x1 = point1[0];
        y1 = point1[1];
        ctx1.lineTo(x1, y1);
      }
      ctx1.stroke();
    }

    function calcPoint1(angle1, r1) {
      let noiseFactor1 = 10;
      let zoom1 = my1 / h1 * 200;
      let x1 =  w1 / 2;
      let y1 =  w1 / 2;
      n1 = (simplex1.noise3D(x / zoom1, y1 / zoom1, ticker1)) * noiseFactor1;
      x1 = Math.cos(angle1) * (r1 + n1) + w1 / 2;
      y1 = Math.sin(angle1) * (r1 + n1) + h1 / 2;
      return [x1, y1];
    }

    setup1();
    draw1();

