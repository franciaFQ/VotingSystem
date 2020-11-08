$(document).ready(function(){
	$('.btn-sideBar-SubMenu').on('click', function(){
		var SubMenu=$(this).next('ul');
		var iconBtn=$(this).children('.zmdi-caret-down');
		if(SubMenu.hasClass('show-sideBar-SubMenu')){
			iconBtn.removeClass('zmdi-hc-rotate-180');
			SubMenu.removeClass('show-sideBar-SubMenu');
		}else{
			iconBtn.addClass('zmdi-hc-rotate-180');
			SubMenu.addClass('show-sideBar-SubMenu');
		}
	});
	function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
		$(document).ready(function(){
		$(document).on("keydown", disableF5);
	});
	$('.btn-exit-system').on('click', function(){
		swal({
		  	title: 'Desea salir del sistema',
		  	text: "Seleccione una de las siguientes acciones en los botones asignados",
		  	type: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#F44336',
		  	cancelButtonColor: '#03A9F4',
		  	confirmButtonText: '<i class="zmdi zmdi-run"></i> Deseo Finalizar Sesión',
		  	cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> Deseo Regresar'
		}).then(function () {
			window.location.href="logout.php";
		});
	});
		$('.btn-menu-dashboard').on('click', function(){
		var body=$('.dashboard-contentPage');
		var sidebar=$('.dashboard-sideBar');
		if(sidebar.css('pointer-events')=='none'){
			body.removeClass('no-paddin-left');
			sidebar.removeClass('hide-sidebar').addClass('show-sidebar');
		}else{
			body.addClass('no-paddin-left');
			sidebar.addClass('hide-sidebar').removeClass('show-sidebar');
		}
	});
});
(function($){
    $(window).on("load",function(){
        $(".dashboard-sideBar-ct").mCustomScrollbar({
        	theme:"light-thin",
        	scrollbarPosition: "inside",
        	autoHideScrollbar: true,
        	scrollButtons: {enable: true}
        });
        $(".dashboard-contentPage, .Notifications-body").mCustomScrollbar({
        	theme:"dark-thin",
        	scrollbarPosition: "inside",
        	autoHideScrollbar: true,
        	scrollButtons: {enable: true}
        });
    });
})(jQuery);