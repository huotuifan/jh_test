<script type="text/javascript">{literal}(function(a,b,c,d){function e(){clearTimeout(i);for(var c=a.innerWidth||b.documentElement.clientWidth||b.body.clientWidth||0,e,f,o,p,q=m,u=m-1;q--;){e=l[q].split("="),f=e[0],p=e[1]?e[1].replace(/\s/g,""):q,e=(o=f.match("to"))?parseInt(f.split("to")[0],10):parseInt(f,10),f=o?parseInt(f.split("to")[1],10):d;if(!f&&q===u&&c>e||c>e&&c<=f){g=k+p;break}g=""}h?h!==g&&(h=n.href=g,j&&j(q,c)):(h=n.href=g,j&&j(q,c),k&&(b.head||b.getElementsByTagName("head")[0]).appendChild(n))}function f(){clearTimeout(i),i=setTimeout(e,100)}if(c){var g,h,i,j=typeof c.callback=="function"?c.callback:d,k=c.path?c.path:"",l=c.range,m=l.length,n=b.createElement("link");n.rel="stylesheet",e(),c.dynamic&&(a.addEventListener?a.addEventListener("resize",f,!1):a.attachEvent?a.attachEvent("onresize",f):a.onresize=f)}})(this,this.document,{
    path:'/css/adapt/',dynamic:true,range:[
        '0px   to 480px  = mobile.css',
        '480px to 720px  = 480.css',
        '720px to 960px  = 720.css',
        '960px to 1200px = 960.css',
        '1200px          = 1200.css'
    ]
});{/literal}</script>
