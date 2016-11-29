/**
 * Created by Administrator on 2016/11/16.
 */

$(function(){
    navDisplay('.nav-index-me','150');  //首页
    navDisplay('.nav-about-me','180');  //关于我们

    //window.onmousewheel=document.onmousewheel=function(){return false;}; //禁止鼠标滚轮

    //首页项目展示显示项目名
    $('.project .project-con li').mouseover(function(){
        $(this).children('div').stop().animate({opacity:"1"},200);
        $(this).children('div').children('span').stop().animate({marginTop:"0"},200);
    });
    $('.project .project-con li').mouseout(function(){
        $(this).children('div').stop().animate({opacity:"0"},200);
        $(this).children('div').children('span').stop().animate({marginTop:"450px"},200);
    });
    //首页项目展示左右滑动
    var projectLength = $('.project-con li').length;
    $('.project-con').width(projectLength*320);
    var bodyWidth = document.body.clientWidth;
    $('.project-click .left').click(function(){
        var projectLeft =  parseInt($('.project-con').css("marginLeft"))+640;
        //console.log(projectLeft);
        if(projectLeft<=0){
            $('.project-con').stop().animate({marginLeft:projectLeft},200);
        }else{
            $('.project-con').stop().animate({marginLeft:"0"},200);
        }
    });
    $('.project-click .right').click(function(){
        var projectLeftMin = bodyWidth - (projectLength*320);
        var projectLeft =  parseInt($('.project-con').css("marginLeft"))-640;
        //console.log(projectLeft);
        if(projectLeft>projectLeftMin){
            $('.project-con').stop().animate({marginLeft:projectLeft},200);
        }else{
            $('.project-con').stop().animate({marginLeft:projectLeftMin},200);
        }
    });
    
    //关于我们 - 企业文化
    $('.culture .right li').click(function(){
        $(this).addClass('active').siblings('li').removeClass('active');
    });

    //关于我们 - 荣誉资质
    $('.honor .right').click(function(){
        var marginLeft = parseInt($('.honor ul').css('marginLeft'))-580;
        //console.log(marginLeft);
        if(marginLeft<='-1160'){
            $('.honor ul').stop().animate({marginLeft:'-1160px'},200);
        }else{
            $('.honor ul').stop().animate({marginLeft:marginLeft},200);
        }
    });
    $('.honor .left').click(function(){
        var marginLeft = parseInt($('.honor ul').css('marginLeft'))+580;
        if(marginLeft>='0'){
            $('.honor ul').stop().animate({marginLeft:'0'},200);
        }else{
            $('.honor ul').stop().animate({marginLeft:marginLeft},200);
        }
    });

    //关于我们 - 战略愿景
    $('.strategic-1').mouseover(function(){
        $('.strategic-1 img').attr('src','img/strategic-big-1.jpg');
        $('.strategic-2').stop().animate({left:"610px"},200);
        $('.strategic-3').stop().animate({left:"905px"},200);
    });
    $('.strategic-1').mouseout(function(){
        $('.strategic-1 img').attr('src','img/strategic-1.jpg');
        $('.strategic-2').stop().animate({left:"400px"},200);
        $('.strategic-3').stop().animate({left:"800px"},200);
    });
    $('.strategic-2').mouseover(function(){
        $('.strategic-2 img').attr('src','img/strategic-big-2.jpg');
        $('.strategic-2').stop().animate({left:"295px"},200);
        $('.strategic-3').stop().animate({left:"905px"},200);
    });
    $('.strategic-2').mouseout(function(){
        $('.strategic-2 img').attr('src','img/strategic-2.jpg');
        $('.strategic-2').stop().animate({left:"400px"},200);
        $('.strategic-3').stop().animate({left:"800px"},200);
    });
    $('.strategic-3').mouseover(function(){
        $('.strategic-3 img').attr('src','img/strategic-big-3.jpg');
        $('.strategic-2').stop().animate({left:"295px"},200);
        $('.strategic-3').stop().animate({left:"590px"},200);
    });
    $('.strategic-3').mouseout(function(){
        $('.strategic-3 img').attr('src','img/strategic-3.jpg');
        $('.strategic-2').stop().animate({left:"400px"},200);
        $('.strategic-3').stop().animate({left:"800px"},200);
    });

    //新闻资讯 - 业界资讯
    //$('')

    //业务 - 服务特色
    $('.features-con li').mouseover(function(){
        $(this).children('.text').stop().animate({marginTop:"180px"},200);
    });
    $('.features-con li').mouseout(function(){
        $(this).children('.text').stop().animate({marginTop:"380px"},200);
    });
});


function navDisplay(div,top){   //导航栏子菜单动画
    var time = null;
    $(div).mouseover(function(){
        clearTimeout(time);
        $(this).siblings('ul').stop().css('display','block').animate({height:top},300);
    });
    $(div).mouseout(function(){
        time = setTimeout(function(){
            $(div).siblings('ul').stop().animate({height:"0px"},200);
            setTimeout(function(){
                $(div).siblings('ul').css('display','none');
            },200)
        },500);
    });
    $(div).siblings('ul').mouseover(function(){
        clearTimeout(time);
        $(div).siblings('ul').stop().css('display','block').animate({height:top},300);
    });
    $(div).siblings('ul').mouseout(function(){
        time = setTimeout(function(){
            $(div).siblings('ul').stop().animate({height:"0px"},200);
            setTimeout(function(){
                $(div).siblings('ul').css('display','none');
            },200)
        },100);
    });
};

function clickNewsCon(num){   //新闻动态点击按钮切换
    $('.news-ol-'+num).addClass('active').siblings('li').removeClass('active');
    for(var i=-2;i<3;i++){
        var newsNum = num+i;
        $('.news-'+newsNum).animate({left:i*1020},200);
    }
}

function indexUlActive(num){    //滚动页面时切换首页右边六个按钮
    $('#indexRightUl li').eq(num-1).addClass('active').siblings('li').removeClass('active');
}

function indexScroll(num){  //页面滚动及切换右边小圆点
    $('#indexRightUl li').eq(num-1).addClass('active').siblings('li').removeClass('active');
    if(num=='1'){
        $('body').stop().animate({'scrollTop':"0"},500);
    }else if(num=='2'){
        $('body').stop().animate({'scrollTop':"500"},500);
        $('#companyAbout h3').addClass('animated fadeInDown');
        $('#companyAbout div.left').addClass('animated fadeInLeftBig');
        $('#companyAbout div.right').addClass('animated fadeInRightBig');
    }else if(num=='3'){
        $('body').stop().animate({'scrollTop':"980"},500);
        $('#project h3').addClass('animated fadeInDown');
        //$('#project ul').addClass('animated fadeInRightBig');
        $('#project ul.project-con li').css("opacity","0");
        setTimeout(function(){
            $('#project ul.project-con li:eq(0)').css("opacity","1").addClass('animated fadeInRightBig');
        },0);
        setTimeout(function(){
            $('#project ul.project-con li:eq(1)').css("opacity","1").addClass('animated fadeInRightBig');
        },150);
        setTimeout(function(){
            $('#project ul.project-con li:eq(2)').css("opacity","1").addClass('animated fadeInRightBig');
        },300);
        setTimeout(function(){
            $('#project ul.project-con li:eq(3)').css("opacity","1").addClass('animated fadeInRightBig');
        },450);
        setTimeout(function(){
            $('#project ul.project-con li:eq(4)').css("opacity","1").addClass('animated fadeInRightBig');
        },600);
        setTimeout(function(){
            $('#project ul.project-con li:eq(5)').css("opacity","1").addClass('animated fadeInRightBig');
        },750);
        setTimeout(function(){
            $('#project ul.project-con li:eq(6)').css("opacity","1").addClass('animated fadeInRightBig');
        },900);
    }else if(num=='4'){
        $('body').stop().animate({'scrollTop':"1590"},500);
        $('#service h3').addClass('animated fadeInDown');
        $('#service .estate').addClass('animated slideInLeft');
        $('#service .assets').addClass('animated bounceIn');
        $('#service .business').addClass('animated slideInRight');
    }else if(num=='5'){
        $('body').stop().animate({'scrollTop':"2115"},500);
        $('#news h3').addClass('animated fadeInDown');
        $('#news .news-con').addClass('animated fadeInUpBig');
    }else if(num=='6'){
        $('body').stop().animate({'scrollTop':"2755"},500);
        $('#map img').addClass('animated fadeInUpBig');
    }
}

//bug ie8下点击切换页面无效