//页面加载完毕后触发
window.onload = function () {
	//标签获取
	var obtn = document.getElementById('btn');
	//获取页面可视区高度
	var clientHeight = document.documentElement.clientHeight;
	var timer = null;
	var isTop = true;
	//滚动条滚动触发
	window.onscroll = function () {
		var osTop = document.documentElement.scrollTop || document.body.scrollTop;
		if (osTop >= clientHeight) {
			obtn.style.display = 'block';
		}
		else{
			obtn.style.display = 'none';
		}
		if (!isTop) {
			clearInterval(timer);
		}
		isTop = false;
	};
	//事件绑定
	obtn.onclick = function (){
		//设置定时器
		timer = setInterval(function(){
			//获取滚动条距离顶部的距离 
			var osTop = document.documentElement.scrollTop || document.body.scrollTop;
			//使滚动由快变慢
			var ispeed = Math.floor(-osTop / 5); //向下取整
			document.documentElement.scrollTop = document.body.scrollTop = osTop + ispeed;
			isTop = true;
				//每次滚动条到顶部清除定时器
				if (osTop == 0) {
			clearInterval(timer);
			}
		},30/*隔30毫秒执行一次*/);	
	}											
}
















