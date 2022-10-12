<!doctype html>
<html class="no-js" lang="en-US" >
  
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
      <meta charset="UTF-8" />
    <title>Betterment: How It Works | Understand a Robo-Advisor in 4 Steps</title>
<link rel="stylesheet" href="wp-content/themes/foley/release/foley.dec3179f02968900.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="apple-touch-icon-precomposed" href="favicon-152.png">
<meta name="apple-itunes-app" content="app-id=393156562" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script type="text/javascript">
(window.NREUM||(NREUM={})).loader_config={xpid:"UwYOWVBbGwYAVFZWBwA="};window.NREUM||(NREUM={}),__nr_require=function(t,n,e){function r(e){if(!n[e]){var o=n[e]={exports:{}};t[e][0].call(o.exports,function(n){var o=t[e][1][n];return r(o||n)},o,o.exports)}return n[e].exports}if("function"==typeof __nr_require)return __nr_require;for(var o=0;o<e.length;o++)r(e[o]);return r}({1:[function(t,n,e){function r(t){try{s.console&&console.log(t)}catch(n){}}var o,i=t("ee"),a=t(16),s={};try{o=localStorage.getItem("__nr_flags").split(","),console&&"function"==typeof console.log&&(s.console=!0,o.indexOf("dev")!==-1&&(s.dev=!0),o.indexOf("nr_dev")!==-1&&(s.nrDev=!0))}catch(c){}s.nrDev&&i.on("internal-error",function(t){r(t.stack)}),s.dev&&i.on("fn-err",function(t,n,e){r(e.stack)}),s.dev&&(r("NR AGENT IN DEVELOPMENT MODE"),r("flags: "+a(s,function(t,n){return t}).join(", ")))},{}],2:[function(t,n,e){function r(t,n,e,r,s){try{p?p-=1:o(s||new UncaughtException(t,n,e),!0)}catch(f){try{i("ierr",[f,c.now(),!0])}catch(d){}}return"function"==typeof u&&u.apply(this,a(arguments))}function UncaughtException(t,n,e){this.message=t||"Uncaught error with no additional information",this.sourceURL=n,this.line=e}function o(t,n){var e=n?null:c.now();i("err",[t,e])}var i=t("handle"),a=t(17),s=t("ee"),c=t("loader"),f=t("gos"),u=window.onerror,d=!1,l="nr@seenError",p=0;c.features.err=!0,t(1),window.onerror=r;try{throw new Error}catch(h){"stack"in h&&(t(8),t(7),"addEventListener"in window&&t(5),c.xhrWrappable&&t(9),d=!0)}s.on("fn-start",function(t,n,e){d&&(p+=1)}),s.on("fn-err",function(t,n,e){d&&!e[l]&&(f(e,l,function(){return!0}),this.thrown=!0,o(e))}),s.on("fn-end",function(){d&&!this.thrown&&p>0&&(p-=1)}),s.on("internal-error",function(t){i("ierr",[t,c.now(),!0])})},{}],3:[function(t,n,e){t("loader").features.ins=!0},{}],4:[function(t,n,e){function r(t){}if(window.performance&&window.performance.timing&&window.performance.getEntriesByType){var o=t("ee"),i=t("handle"),a=t(8),s=t(7),c="learResourceTimings",f="addEventListener",u="resourcetimingbufferfull",d="bstResource",l="resource",p="-start",h="-end",m="fn"+p,v="fn"+h,w="bstTimer",y="pushState",g=t("loader");g.features.stn=!0,t(6);var b=NREUM.o.EV;o.on(m,function(t,n){var e=t[0];e instanceof b&&(this.bstStart=g.now())}),o.on(v,function(t,n){var e=t[0];e instanceof b&&i("bst",[e,n,this.bstStart,g.now()])}),a.on(m,function(t,n,e){this.bstStart=g.now(),this.bstType=e}),a.on(v,function(t,n){i(w,[n,this.bstStart,g.now(),this.bstType])}),s.on(m,function(){this.bstStart=g.now()}),s.on(v,function(t,n){i(w,[n,this.bstStart,g.now(),"requestAnimationFrame"])}),o.on(y+p,function(t){this.time=g.now(),this.startPath=location.pathname+location.hash}),o.on(y+h,function(t){i("bstHist",[location.pathname+location.hash,this.startPath,this.time])}),f in window.performance&&(window.performance["c"+c]?window.performance[f](u,function(t){i(d,[window.performance.getEntriesByType(l)]),window.performance["c"+c]()},!1):window.performance[f]("webkit"+u,function(t){i(d,[window.performance.getEntriesByType(l)]),window.performance["webkitC"+c]()},!1)),document[f]("scroll",r,{passive:!0}),document[f]("keypress",r,!1),document[f]("click",r,!1)}},{}],5:[function(t,n,e){function r(t){for(var n=t;n&&!n.hasOwnProperty(u);)n=Object.getPrototypeOf(n);n&&o(n)}function o(t){s.inPlace(t,[u,d],"-",i)}function i(t,n){return t[1]}var a=t("ee").get("events"),s=t(19)(a,!0),c=t("gos"),f=XMLHttpRequest,u="addEventListener",d="removeEventListener";n.exports=a,"getPrototypeOf"in Object?(r(document),r(window),r(f.prototype)):f.prototype.hasOwnProperty(u)&&(o(window),o(f.prototype)),a.on(u+"-start",function(t,n){var e=t[1],r=c(e,"nr@wrapped",function(){function t(){if("function"==typeof e.handleEvent)return e.handleEvent.apply(e,arguments)}var n={object:t,"function":e}[typeof e];return n?s(n,"fn-",null,n.name||"anonymous"):e});this.wrapped=t[1]=r}),a.on(d+"-start",function(t){t[1]=this.wrapped||t[1]})},{}],6:[function(t,n,e){var r=t("ee").get("history"),o=t(19)(r);n.exports=r,o.inPlace(window.history,["pushState","replaceState"],"-")},{}],7:[function(t,n,e){var r=t("ee").get("raf"),o=t(19)(r),i="equestAnimationFrame";n.exports=r,o.inPlace(window,["r"+i,"mozR"+i,"webkitR"+i,"msR"+i],"raf-"),r.on("raf-start",function(t){t[0]=o(t[0],"fn-")})},{}],8:[function(t,n,e){function r(t,n,e){t[0]=a(t[0],"fn-",null,e)}function o(t,n,e){this.method=e,this.timerDuration=isNaN(t[1])?0:+t[1],t[0]=a(t[0],"fn-",this,e)}var i=t("ee").get("timer"),a=t(19)(i),s="setTimeout",c="setInterval",f="clearTimeout",u="-start",d="-";n.exports=i,a.inPlace(window,[s,"setImmediate"],s+d),a.inPlace(window,[c],c+d),a.inPlace(window,[f,"clearImmediate"],f+d),i.on(c+u,r),i.on(s+u,o)},{}],9:[function(t,n,e){function r(t,n){d.inPlace(n,["onreadystatechange"],"fn-",s)}function o(){var t=this,n=u.context(t);t.readyState>3&&!n.resolved&&(n.resolved=!0,u.emit("xhr-resolved",[],t)),d.inPlace(t,y,"fn-",s)}function i(t){g.push(t),h&&(x?x.then(a):v?v(a):(E=-E,O.data=E))}function a(){for(var t=0;t<g.length;t++)r([],g[t]);g.length&&(g=[])}function s(t,n){return n}function c(t,n){for(var e in t)n[e]=t[e];return n}t(5);var f=t("ee"),u=f.get("xhr"),d=t(19)(u),l=NREUM.o,p=l.XHR,h=l.MO,m=l.PR,v=l.SI,w="readystatechange",y=["onload","onerror","onabort","onloadstart","onloadend","onprogress","ontimeout"],g=[];n.exports=u;var b=window.XMLHttpRequest=function(t){var n=new p(t);try{u.emit("new-xhr",[n],n),n.addEventListener(w,o,!1)}catch(e){try{u.emit("internal-error",[e])}catch(r){}}return n};if(c(p,b),b.prototype=p.prototype,d.inPlace(b.prototype,["open","send"],"-xhr-",s),u.on("send-xhr-start",function(t,n){r(t,n),i(n)}),u.on("open-xhr-start",r),h){var x=m&&m.resolve();if(!v&&!m){var E=1,O=document.createTextNode(E);new h(a).observe(O,{characterData:!0})}}else f.on("fn-end",function(t){t[0]&&t[0].type===w||a()})},{}],10:[function(t,n,e){function r(t){var n=this.params,e=this.metrics;if(!this.ended){this.ended=!0;for(var r=0;r<d;r++)t.removeEventListener(u[r],this.listener,!1);if(!n.aborted){if(e.duration=a.now()-this.startTime,4===t.readyState){n.status=t.status;var i=o(t,this.lastSize);if(i&&(e.rxSize=i),this.sameOrigin){var c=t.getResponseHeader("X-NewRelic-App-Data");c&&(n.cat=c.split(", ").pop())}}else n.status=0;e.cbTime=this.cbTime,f.emit("xhr-done",[t],t),s("xhr",[n,e,this.startTime])}}}function o(t,n){var e=t.responseType;if("json"===e&&null!==n)return n;var r="arraybuffer"===e||"blob"===e||"json"===e?t.response:t.responseText;return h(r)}function i(t,n){var e=c(n),r=t.params;r.host=e.hostname+":"+e.port,r.pathname=e.pathname,t.sameOrigin=e.sameOrigin}var a=t("loader");if(a.xhrWrappable){var s=t("handle"),c=t(11),f=t("ee"),u=["load","error","abort","timeout"],d=u.length,l=t("id"),p=t(14),h=t(13),m=window.XMLHttpRequest;a.features.xhr=!0,t(9),f.on("new-xhr",function(t){var n=this;n.totalCbs=0,n.called=0,n.cbTime=0,n.end=r,n.ended=!1,n.xhrGuids={},n.lastSize=null,p&&(p>34||p<10)||window.opera||t.addEventListener("progress",function(t){n.lastSize=t.loaded},!1)}),f.on("open-xhr-start",function(t){this.params={method:t[0]},i(this,t[1]),this.metrics={}}),f.on("open-xhr-end",function(t,n){"loader_config"in NREUM&&"xpid"in NREUM.loader_config&&this.sameOrigin&&n.setRequestHeader("X-NewRelic-ID",NREUM.loader_config.xpid)}),f.on("send-xhr-start",function(t,n){var e=this.metrics,r=t[0],o=this;if(e&&r){var i=h(r);i&&(e.txSize=i)}this.startTime=a.now(),this.listener=function(t){try{"abort"===t.type&&(o.params.aborted=!0),("load"!==t.type||o.called===o.totalCbs&&(o.onloadCalled||"function"!=typeof n.onload))&&o.end(n)}catch(e){try{f.emit("internal-error",[e])}catch(r){}}};for(var s=0;s<d;s++)n.addEventListener(u[s],this.listener,!1)}),f.on("xhr-cb-time",function(t,n,e){this.cbTime+=t,n?this.onloadCalled=!0:this.called+=1,this.called!==this.totalCbs||!this.onloadCalled&&"function"==typeof e.onload||this.end(e)}),f.on("xhr-load-added",function(t,n){var e=""+l(t)+!!n;this.xhrGuids&&!this.xhrGuids[e]&&(this.xhrGuids[e]=!0,this.totalCbs+=1)}),f.on("xhr-load-removed",function(t,n){var e=""+l(t)+!!n;this.xhrGuids&&this.xhrGuids[e]&&(delete this.xhrGuids[e],this.totalCbs-=1)}),f.on("addEventListener-end",function(t,n){n instanceof m&&"load"===t[0]&&f.emit("xhr-load-added",[t[1],t[2]],n)}),f.on("removeEventListener-end",function(t,n){n instanceof m&&"load"===t[0]&&f.emit("xhr-load-removed",[t[1],t[2]],n)}),f.on("fn-start",function(t,n,e){n instanceof m&&("onload"===e&&(this.onload=!0),("load"===(t[0]&&t[0].type)||this.onload)&&(this.xhrCbStart=a.now()))}),f.on("fn-end",function(t,n){this.xhrCbStart&&f.emit("xhr-cb-time",[a.now()-this.xhrCbStart,this.onload,n],n)})}},{}],11:[function(t,n,e){n.exports=function(t){var n=document.createElement("a"),e=window.location,r={};n.href=t,r.port=n.port;var o=n.href.split("://");!r.port&&o[1]&&(r.port=o[1].split("../index.html")[0].split("@").pop().split(":")[1]),r.port&&"0"!==r.port||(r.port="https"===o[0]?"443":"80"),r.hostname=n.hostname||e.hostname,r.pathname=n.pathname,r.protocol=o[0],"/"!==r.pathname.charAt(0)&&(r.pathname="/"+r.pathname);var i=!n.protocol||":"===n.protocol||n.protocol===e.protocol,a=n.hostname===document.domain&&n.port===e.port;return r.sameOrigin=i&&(!n.hostname||a),r}},{}],12:[function(t,n,e){function r(){}function o(t,n,e){return function(){return i(t,[f.now()].concat(s(arguments)),n?null:this,e),n?void 0:this}}var i=t("handle"),a=t(16),s=t(17),c=t("ee").get("tracer"),f=t("loader"),u=NREUM;"undefined"==typeof window.newrelic&&(newrelic=u);var d=["setPageViewName","setCustomAttribute","setErrorHandler","finished","addToTrace","inlineHit","addRelease"],l="api-",p=l+"ixn-";a(d,function(t,n){u[n]=o(l+n,!0,"api")}),u.addPageAction=o(l+"addPageAction",!0),u.setCurrentRouteName=o(l+"routeName",!0),n.exports=newrelic,u.interaction=function(){return(new r).get()};var h=r.prototype={createTracer:function(t,n){var e={},r=this,o="function"==typeof n;return i(p+"tracer",[f.now(),t,e],r),function(){if(c.emit((o?"":"no-")+"fn-start",[f.now(),r,o],e),o)try{return n.apply(this,arguments)}catch(t){throw c.emit("fn-err",[arguments,this,t],e),t}finally{c.emit("fn-end",[f.now()],e)}}}};a("actionText,setName,setAttribute,save,ignore,onEnd,getContext,end,get".split(","),function(t,n){h[n]=o(p+n)}),newrelic.noticeError=function(t){"string"==typeof t&&(t=new Error(t)),i("err",[t,f.now()])}},{}],13:[function(t,n,e){n.exports=function(t){if("string"==typeof t&&t.length)return t.length;if("object"==typeof t){if("undefined"!=typeof ArrayBuffer&&t instanceof ArrayBuffer&&t.byteLength)return t.byteLength;if("undefined"!=typeof Blob&&t instanceof Blob&&t.size)return t.size;if(!("undefined"!=typeof FormData&&t instanceof FormData))try{return JSON.stringify(t).length}catch(n){return}}}},{}],14:[function(t,n,e){var r=0,o=navigator.userAgent.match(/Firefox[\/\s](\d+\.\d+)/);o&&(r=+o[1]),n.exports=r},{}],15:[function(t,n,e){function r(t,n){if(!o)return!1;if(t!==o)return!1;if(!n)return!0;if(!i)return!1;for(var e=i.split("."),r=n.split("."),a=0;a<r.length;a++)if(r[a]!==e[a])return!1;return!0}var o=null,i=null,a=/Version\/(\S+)\s+Safari/;if(navigator.userAgent){var s=navigator.userAgent,c=s.match(a);c&&s.indexOf("Chrome")===-1&&s.indexOf("Chromium")===-1&&(o="Safari",i=c[1])}n.exports={agent:o,version:i,match:r}},{}],16:[function(t,n,e){function r(t,n){var e=[],r="",i=0;for(r in t)o.call(t,r)&&(e[i]=n(r,t[r]),i+=1);return e}var o=Object.prototype.hasOwnProperty;n.exports=r},{}],17:[function(t,n,e){function r(t,n,e){n||(n=0),"undefined"==typeof e&&(e=t?t.length:0);for(var r=-1,o=e-n||0,i=Array(o<0?0:o);++r<o;)i[r]=t[n+r];return i}n.exports=r},{}],18:[function(t,n,e){n.exports={exists:"undefined"!=typeof window.performance&&window.performance.timing&&"undefined"!=typeof window.performance.timing.navigationStart}},{}],19:[function(t,n,e){function r(t){return!(t&&t instanceof Function&&t.apply&&!t[a])}var o=t("ee"),i=t(17),a="nr@original",s=Object.prototype.hasOwnProperty,c=!1;n.exports=function(t,n){function e(t,n,e,o){function nrWrapper(){var r,a,s,c;try{a=this,r=i(arguments),s="function"==typeof e?e(r,a):e||{}}catch(f){l([f,"",[r,a,o],s])}u(n+"start",[r,a,o],s);try{return c=t.apply(a,r)}catch(d){throw u(n+"err",[r,a,d],s),d}finally{u(n+"end",[r,a,c],s)}}return r(t)?t:(n||(n=""),nrWrapper[a]=t,d(t,nrWrapper),nrWrapper)}function f(t,n,o,i){o||(o="");var a,s,c,f="-"===o.charAt(0);for(c=0;c<n.length;c++)s=n[c],a=t[s],r(a)||(t[s]=e(a,f?s+o:o,i,s))}function u(e,r,o){if(!c||n){var i=c;c=!0;try{t.emit(e,r,o,n)}catch(a){l([a,e,r,o])}c=i}}function d(t,n){if(Object.defineProperty&&Object.keys)try{var e=Object.keys(t);return e.forEach(function(e){Object.defineProperty(n,e,{get:function(){return t[e]},set:function(n){return t[e]=n,n}})}),n}catch(r){l([r])}for(var o in t)s.call(t,o)&&(n[o]=t[o]);return n}function l(n){try{t.emit("internal-error",n)}catch(e){}}return t||(t=o),e.inPlace=f,e.flag=a,e}},{}],ee:[function(t,n,e){function r(){}function o(t){function n(t){return t&&t instanceof r?t:t?c(t,s,i):i()}function e(e,r,o,i){if(!l.aborted||i){t&&t(e,r,o);for(var a=n(o),s=m(e),c=s.length,f=0;f<c;f++)s[f].apply(a,r);var d=u[g[e]];return d&&d.push([b,e,r,a]),a}}function p(t,n){y[t]=m(t).concat(n)}function h(t,n){var e=y[t];if(e)for(var r=0;r<e.length;r++)e[r]===n&&e.splice(r,1)}function m(t){return y[t]||[]}function v(t){return d[t]=d[t]||o(e)}function w(t,n){f(t,function(t,e){n=n||"feature",g[e]=n,n in u||(u[n]=[])})}var y={},g={},b={on:p,addEventListener:p,removeEventListener:h,emit:e,get:v,listeners:m,context:n,buffer:w,abort:a,aborted:!1};return b}function i(){return new r}function a(){(u.api||u.feature)&&(l.aborted=!0,u=l.backlog={})}var s="nr@context",c=t("gos"),f=t(16),u={},d={},l=n.exports=o();l.backlog=u},{}],gos:[function(t,n,e){function r(t,n,e){if(o.call(t,n))return t[n];var r=e();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(t,n,{value:r,writable:!0,enumerable:!1}),r}catch(i){}return t[n]=r,r}var o=Object.prototype.hasOwnProperty;n.exports=r},{}],handle:[function(t,n,e){function r(t,n,e,r){o.buffer([t],r),o.emit(t,n,e)}var o=t("ee").get("handle");n.exports=r,r.ee=o},{}],id:[function(t,n,e){function r(t){var n=typeof t;return!t||"object"!==n&&"function"!==n?-1:t===window?0:a(t,i,function(){return o++})}var o=1,i="nr@id",a=t("gos");n.exports=r},{}],loader:[function(t,n,e){function r(){if(!E++){var t=x.info=NREUM.info,n=p.getElementsByTagName("script")[0];if(setTimeout(u.abort,3e4),!(t&&t.licenseKey&&t.applicationID&&n))return u.abort();f(g,function(n,e){t[n]||(t[n]=e)}),c("mark",["onload",a()+x.offset],null,"api");var e=p.createElement("script");e.src="https://"+t.agent,n.parentNode.insertBefore(e,n)}}function o(){"complete"===p.readyState&&i()}function i(){c("mark",["domContent",a()+x.offset],null,"api")}function a(){return O.exists&&performance.now?Math.round(performance.now()):(s=Math.max((new Date).getTime(),s))-x.offset}var s=(new Date).getTime(),c=t("handle"),f=t(16),u=t("ee"),d=t(15),l=window,p=l.document,h="addEventListener",m="attachEvent",v=l.XMLHttpRequest,w=v&&v.prototype;NREUM.o={ST:setTimeout,SI:l.setImmediate,CT:clearTimeout,XHR:v,REQ:l.Request,EV:l.Event,PR:l.Promise,MO:l.MutationObserver};var y=""+location,g={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net",agent:"js-agent.newrelic.com/nr-1099.min.js"},b=v&&w&&w[h]&&!/CriOS/.test(navigator.userAgent),x=n.exports={offset:s,now:a,origin:y,features:{},xhrWrappable:b,userAgent:d};t(12),p[h]?(p[h]("DOMContentLoaded",i,!1),l[h]("load",r,!1)):(p[m]("onreadystatechange",o),l[m]("onload",r)),c("mark",["firstbyte",s],null,"api");var E=0,O=t(18)},{}]},{},["loader",2,10,4,3]);

</script>

<link rel="icon" href="wp-content/themes/foley/images/logos/site_icon_512.png" sizes="32x32" />

<script type="text/javascript">
        window.TT = "eyJyZWdpc3RyeSI6eyJtb2JpbGVfZ29hbF9wcm9qZWN0aW9uc19xMl8yMDE4X3NhZmVfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2FnZ3JlZ2F0aW9uX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiZ29hbHNfcGhhc2Vfb25lXzIwMTYiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImV4dGVybmFsX2FjY291bnRfdHJhbnNmZXJfcHJldmlld19xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9mb3JjZWRfd2Fsa3Rocm91Z2hfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXdhcmRzX2NlbnRlcl9xMl8yMDE4X2VuYWJsZWQiOnsiZmFsc2UiOjAsInRydWUiOjEwMH0sImFsbG9jYXRpb25fcmV2aWV3X3JlZmFjdG9yX2dvYWxfY3JlYXRpb25fcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJjb21wb25lbnRfcmV2ZXJzYWxzX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInBvcnRmb2xpb191cGdyYWRlX21lc3NhZ2luZ19xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJvbGxvdmVyX3NwbGFzaF9wYWdlX3JlZGVzaWduX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwib2ZmZXJzX3Nob3dfcGFnZV9xMl8yMDE4X2VuYWJsZWQiOnsiZmFsc2UiOjAsInRydWUiOjEwMH0sInJldGFpbF9jcHJfemVuZGVza193ZWJfd2lkZ2V0X3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiZXh0ZXJuYWxfYWNjb3VudF90cmFuc2Zlcl9wcmV2aWV3X3EyXzIwMThfZXhwZXJpbWVudCI6eyJ0cmVhdG1lbnQiOjUwLCJjb250cm9sIjo1MH0sImI0YV9yYWlsc19zaWdudXBfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiaW5fYXBwX2d1aWRlX2Rlc2lnbl8yMDE2X3EzIjp7ImNvbnRyb2wiOjEwMCwibmV3X2Rlc2lnbiI6MH0sInJldGFpbF9jaGFybGllX21lZGlhX2Rlc3RpbmF0aW9uX3Rlc3RfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYjRhX3N1Yl9hY2NvdW50X2RhdGEiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImI0YV9wb3J0Zm9saW9fc3RyYXRlZ2llcyI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwic3ViX2FjY291bnRfcG93ZXJlZF9hZHZpc29yX2Rhc2hib2FyZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibm92ZW1iZXJfMjAxNl9wcm9tb19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjM0LCJoaWdoIjozMywibG93IjozM30sIm1vYmlsZV9mb3JjZWRfd2Fsa3Rocm91Z2hfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwicm9sbG92ZXJfcmVkZXNpZ25lZF90cmFuc2Zlcl9wcmV2aWV3X3EyXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudCI6MH0sImFsbG9jYXRpb25fcmV2aWV3X3JlZmFjdG9yX2dvYWxfY3JlYXRpb25fcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsImV4cGVyaW1lbnQiOjEwMH0sInJldGFpbF9jcHJfemVuZGVza193ZWJfd2lkZ2V0X3EyXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sImZvdXJfb2hfb25lX2tfcm9sbG92ZXJfaW5zdHJ1Y3Rpb25zX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2lvc19maXhfcXVvdm9fY29ubmVjdGlvbnNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfcmV3YXJkc19jZW50ZXJfcTFfMjAxOV9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwidGF4X3llYXJfbWF4X291dF9xMV8yMDE5X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImJhc2ljX3NpZ251cF9mbG93X2NvbnRpbnVlX3NwaW5uZXJfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibW9iaWxlX2dvYWxfcHJvamVjdGlvbnNfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX3dlYl9wYWxzX2Rlc3RpbmF0aW9uX3Rlc3RfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYWxsb2NhdGlvbl9yZXZpZXdfcmVmYWN0b3JfZXhpc3RpbmdfZ29hbF9xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF90b19iNGFfZXZlbnRzX2Rpc2FibGVkIjp7ImZhbHNlIjoxMDAsInRydWUiOjB9LCJwZXJmb3JtYW5jZV9wYWdlX2phdmFzY3JpcHRfcmVmYWN0b3JfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJnb2FsX3JlY29tbWVuZGF0aW9uX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiYWR2aXNvcl9qb2ludF9hY2NvdW50X2dvYWxfY3JlYXRpb25fcTJfMjAxOF9lbmFibGVkIjp7ImZhbHNlIjowLCJ0cnVlIjoxMDB9LCJyZXRhaWxfaXJhX3JvbGxvdmVyX3BpenphX3RyYWNrZXJfcTJfMjAxOF9lbmFibGVkIjp7ImZhbHNlIjoxMDAsInRydWUiOjB9LCJ1YmVyX3NpZ251cF9mbG93X2RlcHJlY2F0aW9uX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInRlbnVyZWRfYXV0b21hdGljX2RlcG9zaXRfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX2VtcG93ZXJpbmdfbWVkaWFfZGVzdGluYXRpb25fdGVzdF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJkYXkwX2VtYWlsX3E0XzIwMTZfZXhwZXJpbWVudCI6eyJ0cnVlIjo1MCwiZmFsc2UiOjUwfSwibW9iaWxlX2F1dG9fd2Fsa3Rocm91Z2hfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfYXV0b21hdGljX3JvbGxvdmVyX2NoZWNrX2RlcG9zaXRfcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyb2xsb3Zlcl9jb21wbGV0ZV90Y3BfYWR2aWNlX3ExXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9hZ2dyZWdhdGlvbl9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfbmVyZF93YWxsZXRfZGVzdGluYXRpb25fdGVzdF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJkYXkwX2VtYWlsX3YyX3ExXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImFsbG9jYXRpb25fcmV2aWV3X3JlZmFjdG9yX2V4aXN0aW5nX2dvYWxfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsImV4cGVyaW1lbnQiOjEwMH0sImRheTBfZW1haWxfdjNfcTFfMjAxN19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwicG9zdF9zaWdudXBfZnJlZV9jYWxsX3ExXzIwMTciOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJsZWdhbF9hY2NvdW50c19vdXRzaWRlX29mX3NwYV9xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF9nZXRfc3RhcnRlZF9vcHRpb25zX3EzXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJiYXNpY19zaWdudXBfbmV3X2NvcHlfdHJlYXRtZW50IjowLCJiYXNpY19zaWdudXBfbmV3X2NvcHlfYW5kX2dvYWxfc2VsZWN0aW9uX3RyZWF0bWVudCI6MTAwfSwibW9iaWxlX2V2ZXJ5ZGF5X3NpZ251cF9xM18yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJtb2JpbGVfYXV0b193YWxrdGhyb3VnaF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJtb2JpbGVfYW5kcm9pZF9maXhfcXVvdm9fY29ubmVjdGlvbnNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJ0ZW51cmVkX2F1dG9tYXRpY19kZXBvc2l0X3EzXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3NtYXJ0X3NhdmVyX2luX2dvYWxfc2VsZWN0aW9uX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImI0Yl9jb250cmlidXRpb25fc291cmNlX2JyZWFrZG93bl9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJiNGJfb25ib2FyZGluZ19mbG93X291dHNpZGVfc3BhIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtYXJjaF9tb250aGx5X2VtYWlsX3JlY2VpdmVkIjp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibWFyY2hfbW9udGhseV9lbWFpbF9yZWNlaXZlZF93aXRoX2N0YSI6eyJzaW5nbGVfY3RhIjo1MCwiZG91YmxlX2N0YSI6NTB9LCJkZWNvbnZlcnNpb25fcmVwb3J0c19nZW5lcmFibGUiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm9mZl90cmFja19nb2FsX3Rhc2tfcTFfMjAxN19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwicHJpY2luZ19wbGFuX3NpZ251cF9pbnZlc3RhYmxlX2Fzc2V0c192YWx1ZV9pbnB1dF8yMDE3Ijp7InJhZGlvIjowLCJ2YWx1ZSI6MTAwfSwiZGF5MF9lbWFpbF9kZWxpdmVyeV90aW1lX3ExXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImJyb2NodXJlX3plbmRlc2tfdGFsa19xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJyZXRhaWxfbGlzdGVuX21vbmV5X21hdHRlcnNfZGVzdGluYXRpb25fdGVzdF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJpbmNsdWRlX2FkdmljZV9pbl9xdWFydGVybHlfc3RhdGVtZW50X3ExXzIwMTciOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJiNGFfZ29hbF9zdGF0dXNfZGlzYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImZvcm1fcmVkZXNpZ25fZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX2V2ZXJ5ZGF5X3NpZ251cF9xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInBlcmZvcm1hbmNlX3BhZ2VfaW1wcm92ZW1lbnRzX3EzXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV3YXJkc19jZW50ZXJfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwibW9iaWxlX2dyYXBoaW5nX3E0XzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9ncmFwaGluZ192Ml9xNF8yMDE3X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfaW52ZXN0b3BlZGlhX2Rlc3RpbmF0aW9uX3Rlc3RfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYjRiX3JlYWN0X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm1vYmlsZV9vdXRzbWFydF9hdmVyYWdlX2hvbWVfc2NyZWVuX3EzXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX291dHNtYXJ0X2F2ZXJhZ2VfaG9tZV9zY3JlZW5fcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwicmV0YWlsX3VuZnVuZGVkX3NpbmdsZV9kZXBvc2l0X3E0XzIwMThfb2ZmZXJfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF9zbWFydF9zYXZlcl9pbl9nb2FsX3NlbGVjdGlvbl9xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF80MDFrX3doaXRlX2dsb3ZlX3JvbGxvdmVyX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9hbmRyb2lkX3Jld2FyZHNfY2VudGVyX3ExXzIwMTlfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiZ2Fpbl9sb3NzX3JlcG9ydHNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfZ2VuZXJhbF9hZmZpbGlhdGVfZGVzdGluYXRpb25fdGVzdF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJ1bmZ1bmRlZF93ZWxjb21lX3Nlcmllc19maXJzdF93ZWVrX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImZ1bmRlZF93ZWxjb21lX3Nlcmllc19jYW1wYWlnbl9xM18yMDE3X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAsInRyZWF0bWVudCI6OTB9LCJtb2JpbGVfaW5pdGlhbF9vbmVfdGltZV9kZXBvc2l0X3EyXzIwMTdfZW5hYmxlZCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sImludGVncmF0aW9uX2Vycm9yX2Rpc3BsYXlfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwicmV0YWlsX3R3b193YXlfc3dlZXBfcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtaW50X3RyYW5zYWN0aW9uc19xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9nb2FsX2ZhYl9xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJyZXRhaWxfdGVudXJlZF9zbWFydF9zYXZlcl9wcm9tb19zaXhfbW9udGhzX3EzXzIwMThfZW5yb2xsbWVudF9jcmVhdGlvbl9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfdGVudXJlZF9zbWFydF9zYXZlcl9wcm9tb190aHJlZV9tb250aHNfcTNfMjAxOF9lbnJvbGxtZW50X2NyZWF0aW9uX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF9maXJzdF9yZWZlcnJhbF9lbWFpbF9xM18yMDE4X3YyX2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJhcHBfZ3VpZGVfdmlzdWFsX3EyXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjozNCwic2luZ2xlX3Rhc2siOjMzLCJ0aHJlZV90YXNrIjozM30sImRpcmVjdF9tYWlsX2Z1bmRpbmdfcmVtaW5kZXJfcTJfMjAxN19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX2VtYWlsX3N0ZXBfZnJhbWluZ190cmlhbGluZ19xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJyZXRhaWxfd2hpdGVfZ2xvdmVfaXJhX3JvbGxvdmVyc19xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImI0YV9hZHZpc29yX3RydXN0X2NyZWF0aW9uX3EzXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiZXh0ZXJuYWxfYWNjb3VudF9vdmVycmlkZW5feWllbGRfcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJhcHBfZ3VpZGVfdmlzdWFsX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJzaW5nbGVfdGFzayI6NTAsInRocmVlX3Rhc2siOjUwfSwicTFfMjAxN19jb21wbGlhbmNlX3N0YXRlX3RheF9ub3RpZmljYXRpb25fZWxpZ2libGUiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF9zbWFydF9zYXZlcl9pbl9ndWlkZWRfc2lnbnVwX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImRyX3BlcnNvbmFsX3JlZmVycmFsX2NyZWF0aW9uX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInVuZnVuZGVkX3dlbGNvbWVfc2VyaWVzX2NhbXBhaWduX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMCwidHJlYXRtZW50Ijo5MH0sIm1vYmlsZV9zdW1tYXJ5X2RlcG9zaXRfYnV0dG9uX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sInJldGFpbF93ZWxjb21lX3NjcmVlbl9zbWFydF9zYXZlcl9xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfZ2V0X3N0YXJ0ZWRfZmluYW5jaWFsX3BsYW5fcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjI1LCJ0cmVhdG1lbnRfZ3VpZGVkX3NpZ251cF9vbmx5IjoyNSwidHJlYXRtZW50X2ZpbmFuY2lhbF9wbGFuX29ubHkiOjI1LCJ0cmVhdG1lbnRfZmluYW5jaWFsX3BsYW5fYWx0IjoyNX0sInJldGFpbF9hcHBfZGF5XzdfdW5mdW5kZWRfc2luZ2xlX2RlcG9zaXRfb2ZmZXJfZW5yb2xsbWVudF9qb2JfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX2luX2FwcF9ndWlkZV9leHRyYV90YXNrc19xNF8yMDE4X3YyX2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJ0d29fd2F5X3N3ZWVwX2JvdW5kX2FkanVzdG1lbnRfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfc2hvd19hY2F0X2N0YV9xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInRlbnVyZWRfdGF4X3llYXJfbWF4X291dF9xMV8yMDE5X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfbGVnYWxfYWNjb3VudF9pbl9iYXNpY19zaWdudXBfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX3R3b190YXNrc19pbl9hcHBfZ3VpZGVfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfZGVmaW5lX2ludmVzdGFibGVfYXNzZXRzX3ExXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudCI6MH0sIm1vYmlsZV9kZW1vX21vZGVfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwibW9iaWxlX25vdGhpbmdfcTFfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibW9iaWxlX291dHNtYXJ0X2F2ZXJhZ2VfaG9tZV9zY3JlZW5fcTNfMjAxOF92Ml9lbmFibGVkIjp7ImZhbHNlIjoxMDAsInRydWUiOjB9LCJicm9jaHVyZV9yZWFjdF9zd2l0Y2hpbmdfY29zdF9jYWxjdWxhdG9yX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3doaXRlX2dsb3ZlX2lyYV9yb2xsb3ZlcnNfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmVmZXJfYV9mcmllbmRfdjJfZW5hYmxlZCI6eyJmYWxzZSI6MTAwLCJ0cnVlIjowfSwiYjRhX2hpZ2hfcHJpb3JpdHlfbm90aWZpY2F0aW9uX2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJhZGRfZ29hbCI6MCwidGF4YWJsZV9hY2F0cyI6MCwiZGlnaXRhbF9yb2xsb3Zlcl91cGRhdGUiOjAsInRheF93aXRoaG9sZGluZyI6MCwiam9pbnRfYWNjb3VudCI6MCwicm9sbG92ZXIiOjB9LCJyZXRhaWxfdGVudXJlZF9zbWFydF9zYXZlcl9wcm9tb192Ml9xM18yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnRfdGhyZWVfbW9udGhzIjowLCJ0cmVhdG1lbnRfc2l4X21vbnRocyI6MH0sIm1vYmlsZV9kZW1vX21vZGVfcTFfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibW9iaWxlX2ludmVzdGVkX2dyYXBoX3ExXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm5hdmlnYXRpb25fc2lkZWJhcl91cGRhdGVzX3EzXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sIm1vYmlsZV9xdW92b19iYW5rX2xpbmtpbmdfcTNfMjAxOF9lbmFibGVkIjp7ImZhbHNlIjowLCJ0cnVlIjoxMDB9LCJuYXZpZ2F0aW9uX3NpZGViYXJfdXBkYXRlc19xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF9hcHBfbmF2X2Vhcm5fcmV3YXJkc19xM18yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJiNGFfbmF2aWdhdGlvbl9yZWFyY2hpdGVjdHVyZV9xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9vdXRzbWFydF9hdmVyYWdlX2hvbWVfc2NyZWVuX3EzXzIwMThfdjJfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudCI6MH0sIm1vYmlsZV9pb3NfdHdvX3dheV9zd2VlcF9xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF90YXhfdGltZV9uYXZfaXRlbV9xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJyZXRhaWxfdGVudXJlZF9zbWFydF9zYXZlcl9wcm9tb192Ml9xM18yMDE4X2dhdGVfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudCI6MH0sIm1vYmlsZV9zaWdudXBfY29weV9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJtb2JpbGVfcXVvdm9fYmFua19saW5raW5nX3EzXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sImJyb2NodXJlX2hvbWVwYWdlX2Rlc2t0b3BfbWFnZ2llX2hlcm9fcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX3R3b190YXNrc19pbl9hcHBfZ3VpZGVfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiZGVmYXVsdF9nb2Fsc19xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfc2hvd19hY2F0X2N0YV9xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRpcmVfZ3VpZGVfc2V0dXBfc3BlbmRpbmdfc3RlcF9xNF8yMDE3X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJicm9jaHVyZV9tb2JpbGVfbWFnZ2llX2hlcm9fcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYnJvY2h1cmVfbW9iaWxlX25hdl9iMmJfbGlua3NfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYjRhX2I0Yl9kZWZhdWx0X2dvYWxzX3E0XzIwMThfZW5hYmxlZCI6eyJmYWxzZSI6MTAwLCJ0cnVlIjowfSwibW9iaWxlX2lvc19yZXdhcmRzX2NlbnRlcl9xMV8yMDE5X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm1vYmlsZV9hbmRyb2lkX3R3b193YXlfc3dlZXBfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfdHdvX3dheV9zd2VlcF9jYW5jZWxhYmxlX3RyYW5zYWN0aW9uc19xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm1vYmlsZV9pb3Nfc3VtbWFyeV9mYWJfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibW9iaWxlX2dvYWxfZ3JhcGhfcTFfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmVjb21tZW5kZWRfdGF4X3N0cmF0ZWdpZXNfc2lnbnVwX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sInByb3h5X3RpY2tlcnNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfaW5fYXBwX2d1aWRlX2V4dHJhX3Rhc2tzX3E0XzIwMThfdjJfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2dvYWxfcHJvamVjdGlvbnNfcTJfMjAxOF9zYWZlX2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJiNGFfc2hvd19iYWxhbmNlc19jbGllbnRfaW5kZXhfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfaGlnaF9sZXZlbF9maW5hbmNpYWxfcGxhbl9idXR0b25fcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50X2ZpbmFuY2lhbF9wbGFuIjowLCJ0cmVhdG1lbnRfYWRkX2dvYWwiOjB9LCJqb2ludF9hY2NvdW50X3NpZ251cF9pbnRlbnRfcXVlc3Rpb25fZW5hYmxlZCI6eyJ0cnVlIjo1MCwiZmFsc2UiOjUwfSwicXVvdm9fcmVmcmVzaGluZ19yZWdhcmRsZXNzX29mX2Z1bmRpbmdfZW5hYmxlZCI6eyJ0cnVlIjo1MCwiZmFsc2UiOjUwfSwiam9pbnRfYWNjb3VudF9zaWdudXBfaW50ZW50X3F1ZXN0aW9uX3YyX2VuYWJsZWQiOnsiZmFsc2UiOjAsInRydWUiOjEwMH0sInJvbGxvdmVyX3Byb21vdGlvbl8yMDE2X3EyX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImRvY3VtZW50X3ZhdWx0X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInRlbnVyZWRfcm9sbG92ZXJfcHJvbW9fcTFfMjAxOV9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX2xlZ2FsX2FjY291bnRfaW5fYmFzaWNfc2lnbnVwX3E0XzIwMThfZW5hYmxlZCI6eyJmYWxzZSI6MCwidHJ1ZSI6MTAwfSwicmV0YWlsX2Nhc2hfYW5hbHlzaXNfd2l0aG91dF9zbWFydF9zYXZlcl9xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImZsZXhpYmxlX3BvcnRmb2xpb19jb21tb2RpdGllc19lbmFibGVkX3E0XzIwMTgiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF90cmFuc2Zlcl9pbXByb3ZlbWVudF9hY2F0c19mbG93X3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiZGlnaXRhbF9kdXBsaWNhdGVfc3RhdGVtZW50c19mb3Jfa3BtZ19lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJkaWdpdGFsX2R1cGxpY2F0ZV9zdGF0ZW1lbnRzX2Zvcl9zcF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJkaWdpdGFsX2R1cGxpY2F0ZV9zdGF0ZW1lbnRzX2Zvcl9wd2NfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiZGlnaXRhbF9kdXBsaWNhdGVfc3RhdGVtZW50c19mb3JfZGVsb2l0dGVfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiZGlnaXRhbF9kdXBsaWNhdGVfc3RhdGVtZW50c19mb3JfZXlfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwic2VuZF9pZG9sb2d5X2VtYWlsX3E0XzIwMTZfZW5hYmxlZCI6eyJmYWxzZSI6MCwidHJ1ZSI6MTAwfSwiZHJfcG9ydGZvbGlvX21hbmFnZW1lbnRfYXBpX3ExXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiYWxsb2NhdGlvbl9zZWxlY3Rpb25fcmVmYWN0b3JfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJhZHZpc29yX25ldHdvcmtfcTRfMjAxNl9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJ1cGdyYWRlX3BsYW5fdGFza19xMV8yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInNwZWNpYWxpemVkX2VkaXRfZ29hbF9leHBlcmllbmNlXzIwMTZfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwicGhvbmVfYWR2aWNlX3Rhc2tfcTRfMjAxNl9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJwdXNoX25vdGlmaWNhdGlvbnNfcTFfMjAxN19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJmdW5kX3RvX3VwZ3JhZGVfcGxhbl90YXNrX3ExXzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjo1MCwiZmFsc2UiOjUwfSwidGhpcnR5X2RheV9mcmVlX3RyaWFsX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInBvcnRmb2xpb19tYW5hZ2VtZW50X2FwaV8yMDE3X3E0X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImI0YV9jb21wbGlhbmNlX2ZlZXNfMjAxN19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfemVuZGVza19sdHZfcXVldWVfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX3RyYW5zZmVyX2ltcHJvdmVtZW50X2FjYXRzX2Zsb3dfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibW9iaWxlX2dyYXBoaW5nX3E0XzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX2ludmVzdGluZ19hc3Nlc3NtZW50X2NvbnN1bHRhdGlvbl9lbmFibGVkIjp7ImZhbHNlIjoxMDAsInRydWUiOjB9LCJ0YXhfeWVhcl9tYXhfb3V0X3ExXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicHJpY2luZ19wbGFuX3NpZ251cF9mbG93X3ExXzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX2dvYWxfZmFiX3ExXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiYjRhX2FkZF9nb2FsX25vdGlmaWNhdGlvbl9xNF8yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImFwcF9ndWlkZV92aXN1YWxfcTJfMjAxN19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfbWVzc2FnaW5nX3EzXzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiZGlyZWN0X21haWxfZnVuZGluZ19yZW1pbmRlcl9xMl8yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9uYXRpdmVfc2lnbnVwX3EyXzIwMTdfZW5hYmxlZCI6eyJmYWxzZSI6MCwidHJ1ZSI6MTAwfSwibW9iaWxlX3N1bW1hcnlfZGVwb3NpdF9idXR0b25fcTNfMjAxN19lbmFibGVkIjp7ImZhbHNlIjowLCJ0cnVlIjoxMDB9LCJwaG9uZV9udW1iZXJfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicGVyZm9ybWFuY2VfcGFnZV9pbXByb3ZlbWVudHNfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwicTFfMjAxN19jb21wbGlhbmNlX3N0YXRlX3RheF9ub3RpZmljYXRpb25fZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX2ZyZWVfdGltZV9wcm9tb19xM18yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9nb2FsX3Byb2plY3Rpb25zX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwic2RhXzEwMGtfZ2F0ZV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF90ZW51cmVkX3JvbGxvdmVyX2RvbGxhcnNfbWFuYWdlZF9mcmVlX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX3NpZ251cF9jb3B5X3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiYjRhX2Fkdmlzb3JfaW1wZXJzb25hdGlvbl9tb2RhbF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfZ3JhcGhpbmdfdjJfcTRfMjAxN19lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtb2JpbGVfaW52ZXN0ZWRfZ3JhcGhfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJhZGRfcHJlZmVycmVkX211bmlfYm9uZF9sb2NhbGVfc2VsZWN0aW9uX3RvX2RyX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF9kb2N0b3JfcmVicmFuZF9xMV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF9hbWVyaWNhbl9haXJsaW5lc19vZmZlcl9xMV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9pb3Nfc3VtbWFyeV9mYWJfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJkcl9wYXBlcmxlc3NfZGlzdHJpYnV0aW9uX2VsaWdpYmlsaXR5X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImI0YV9zZGFfcG9ydGZvbGlvc19xMV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInBvcnRmb2xpb19tYW5hZ2VtZW50X2dvYWxfcG9ydGZvbGlvXzIwMTdfcTRfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwicGxhbl9mZWVzX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF90cnVzdGVkX2NvbnRhY3RfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2dvYWxfZ3JhcGhfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtb2JpbGVfZGVtb19tb2RlX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX25vdGhpbmdfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJzbW9vY2hfYXV0b19yZXNwb25kZXJfcTNfMjAxN19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJibGFja3JvY2tfaW5jb21lX3BvcnRmb2xpb19xMl8yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF9kZWZpbmVfaW52ZXN0YWJsZV9hc3NldHNfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtb2JpbGVfZGVtb19tb2RlX3ExXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwicmV0YWlsX3RyYW5zZmVyX2ltcHJvdmVtZW50X2lyYV9saW5rX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF90cmFuc2Zlcl9pbXByb3ZlbWVudF90YXhhYmxlX2xpbmtfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiZGVmYXVsdF9nb2Fsc19xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF90cmFuc2Zlcl9pbXByb3ZlbWVudF9tYW5hZ2VfdHJhbnNmZXJzX2N0YV9xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF90cmFuc2Zlcl9pbXByb3ZlbWVudF9tYW5hZ2VfdHJhbnNmZXJzX3NjcmVlbl9jdGFfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjI1LCJ0cmVhdG1lbnRfMSI6MjUsInRyZWF0bWVudF8yIjoyNSwidHJlYXRtZW50XzMiOjI1fSwiZm91cl9vaF9vbmVfa19yb2xsb3Zlcl9pbnN0cnVjdGlvbnNfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYjRhX3NlY29uZGFyeV9hZHZpc29yX3JlZmFjdG9yX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3RyYW5zZmVyX2ltcHJvdmVtZW50X3BhZ2VfbGlua3NfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfZ3VpZGVkX3NpZ251cF9kZWJ0X3F1ZXN0aW9uX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudCI6MH0sInJldGFpbF9xM19maXhfcXVvdm9fY29ubmVjdGlvbnNfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfX0sInVybCI6Imh0dHBzOlwvXC90dC5iZXR0ZXJtZW50LmNvbSIsImNvb2tpZURvbWFpbiI6ImJldHRlcm1lbnQuY29tIiwiZW5jb2RlZEF0IjoiMjAxODEyMTkxMTUzMTQifQ==";
    </script>







</head>



  <body class="page-template page-template-page-landing page-template-page-landing-php page page-id-37073 sc-backgroundColor-grey-10">
    <div class="sc-SiteLayout sc-SiteLayout--constrained sc-backgroundColor-white" data-js-hook="SiteLayout">

           <?php
//add header
include('headerX.php');

?>
  
      <main class="sc-SiteLayout-main">
              

<div class="sc-SectionLayout sc-backgroundColor-grey-60 sc-SectionBackgroundImage TripleLinesABackground sc-SectionBackgroundImage--centerTop sc-p-v--xl " data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot ">
                      <div class="sc-ContentGrid u-flexJustifyBetween u-flexRowReverse u-flexAlignItemsCenter">
        <div class="sc-ContentGrid-item u-col-12 u-col-6@lg sc-p-b--s sc-p-b-lg--0 u-overflowHidden">
          <div class="VideoPreview">
                                          <img
    src="wp-content/themes/foley/images/people/ruk_chrissy_sitting.jpg"
  alt=""
  
>

                            <a class="u-flexInline u-flexJustifyCenter u-flexAlignItemsCenter VideoPreview-playContainer" href="javascript:void(0)" data-behavior-video-play-click data-video-id="A-9II-zBq1k">
                <div class="u-displayFlex u-flexJustifyCenter u-flexAlignItemsCenter u-rounded sc-backgroundColor-blue sc-p--s">
                  <span class="sc-Icon sc-Icon--m sc-Icon--white">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-label="Play video"  role="img">
&lt;title&gt;Play video&lt;/title&gt;
  <polygon points="15 8 5 16 5 0"/>
</svg>
</span>

                </div>
              </a>
                      </div>
        </div>

        <div class="sc-ContentGrid-item u-col-12 u-col-5@lg">
          <h1 class="u-knockout">HOW IT WORKS</h1>
                      <p class="u-knockout">Betterment takes sophisticated investing strategies and makes them better with personalized guidance and tax-smart technology. Here's what you can expect.</p>
          
                  </div>
      </div>
      
        </div>
    </div>
  </div>
</div>

      

<div class="sc-SectionLayout sc-SectionLayout--spacious  sc-backgroundColor-grey-10" data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot ">
                      <div class="sc-ContentGrid u-flexJustifyBetween u-flexAlignItemsCenter u-flexRowReverse">
        <div class="sc-ContentGrid-item u-col-12 u-col-6@lg sc-p-b--s sc-p-b-lg--0 sc-m-b--m sc-m-b-lg--0 u-overflowHidden">
                      <img
    src="wp-content/themes/foley/images/product/goals_illustration.png"
  alt=""
  
>

                  </div>

                  <div class="sc-ContentGrid-item u-flex u-flexWrap u-col-12 u-col-5@lg">
            <div class="NumberIcon u-flex u-col-12 u-col-2-of-10@lg u-flexAlignSelfStart sc-p-t-lg--xs sc-m-b--s sc-m-b-lg--0">
              <span class="NumberIcon-content u-superTitle u-border-t">01</span>
            </div>

            <div class="u-col-12 u-col-8-of-10@lg">
                      
              <h2 class="sc-m-b--l">We ask about you.</h2>

                              <p>What are you saving for? Maybe you’re buying a home, paying for college, saving for retirement, or building an emergency fund. Or, maybe you’re just investing for the sake of investing.</p><p> No matter your goal, we’ll ask you how much you’re hoping to save and when you’ll need your money.</p>
              
              
                          </div>
                  </div>
              </div>
      
        </div>
    </div>
  </div>
</div>

      

<div class="sc-SectionLayout sc-SectionLayout--spacious " data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot ">
                      <div class="sc-ContentGrid u-flexJustifyBetween u-flexAlignItemsCenter ">
        <div class="sc-ContentGrid-item u-col-12 u-col-6@lg sc-p-b--s sc-p-b-lg--0 sc-m-b--m sc-m-b-lg--0 u-overflowHidden">
                      <img
    src="wp-content/themes/foley/images/product/portfolio_illustration.png"
  alt=""
  
>

                  </div>

                  <div class="sc-ContentGrid-item u-flex u-flexWrap u-col-12 u-col-5@lg">
            <div class="NumberIcon u-flex u-col-12 u-col-2-of-10@lg u-flexAlignSelfStart sc-p-t-lg--xs sc-m-b--s sc-m-b-lg--0">
              <span class="NumberIcon-content u-superTitle u-border-t">02</span>
            </div>

            <div class="u-col-12 u-col-8-of-10@lg">
                      
              <h2 class="sc-m-b--l">We'll build you a portfolio.</h2>

                              <p>Once we know a bit about you and your investing goals, we’ll build a personalized portfolio with a risk level and investment mix that suits each goal. And if you’d like to adjust that mix, you can.</p><p>Learn more about our a portfolio strategies and how we manage your investments.</p>
              
              
                              
                          </div>
                  </div>
              </div>
      
        </div>
    </div>
  </div>
</div>

      

<div class="sc-SectionLayout sc-SectionLayout--spacious  sc-backgroundColor-grey-10" data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot ">
                      <div class="sc-ContentGrid u-flexJustifyBetween u-flexAlignItemsCenter u-flexRowReverse">
        <div class="sc-ContentGrid-item u-col-12 u-col-6@lg sc-p-b--s sc-p-b-lg--0 sc-m-b--m sc-m-b-lg--0 u-overflowHidden">
                      <img
    src="wp-content/themes/foley/images/product/web_retirement_advice.png"
  alt="Betterment retirement advice on screen"
  
>

                  </div>

                  <div class="sc-ContentGrid-item u-flex u-flexWrap u-col-12 u-col-5@lg">
            <div class="NumberIcon u-flex u-col-12 u-col-2-of-10@lg u-flexAlignSelfStart sc-p-t-lg--xs sc-m-b--s sc-m-b-lg--0">
              <span class="NumberIcon-content u-superTitle u-border-t">03</span>
            </div>

            <div class="u-col-12 u-col-8-of-10@lg">
                      
              <h2 class="sc-m-b--l">We’ll help you decide how much to invest.</h2>

                              <p>For each of your investing goals, we’ll recommend how much you should deposit initially and on an ongoing basis. When it comes to retirement, we’ll also suggest which retirement accounts you should use, and how much you should save into each account. We can even automate your deposits so you don’t have to worry about it. </p><p>No matter the investing plan you choose, we’ll keep you up-to-date on how you’re tracking to help you reach your goal by the time you’d like to.</p>
              
              
                          </div>
                  </div>
              </div>
      
        </div>
    </div>
  </div>
</div>

      

<div class="sc-SectionLayout sc-p-v--48" data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot ">
            
        </div>
    </div>
  </div>
</div>

      

<div class="sc-SectionLayout sc-SectionLayout--spacious sc-p-v--m" data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot ">
                      <div class="sc-ContentGrid u-flexJustifyBetween u-flexAlignItemsCenter ">
        <div class="sc-ContentGrid-item u-col-12 u-col-6@lg sc-p-b--s sc-p-b-lg--0 sc-m-b--m sc-m-b-lg--0 u-overflowHidden">
                      <img
    src="wp-content/themes/foley/images/product/web_summary_mobile_portfolio.png"
  alt="Betterment investing app on laptop and phone"
  
>

                  </div>

                  <div class="sc-ContentGrid-item u-flex u-flexWrap u-col-12 u-col-5@lg">
            <div class="NumberIcon u-flex u-col-12 u-col-2-of-10@lg u-flexAlignSelfStart sc-p-t-lg--xs sc-m-b--s sc-m-b-lg--0">
              <span class="NumberIcon-content u-superTitle u-border-t">04</span>
            </div>

            <div class="u-col-12 u-col-8-of-10@lg">
                      
              <h2 class="sc-m-b--l">Our technology manages your money.</h2>

                              <p>Here’s where our technology gets to work. We’ll rebalance your portfolio to maintain your preferred risk level. As your investments produce dividends, we reinvest them for you to avoid cash-drag.</p><p>We put the right investments in the right types of accounts. And when it’s time to sell a portion of your portfolio we'll sell the holdings in a tax-efficient way, helping to reduce your tax burden.</p>
              
              
                          </div>
                  </div>
              </div>
      
        </div>
    </div>
  </div>
</div>

      


<div class="sc-SectionLayout sc-p-v--m" data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot sc-col-12 sc-p-t--xs ">
                      <div class="sc-ContentGrid">
        <div class="sc-ContentGrid-item sc-col-12 sc-col-md-6  sc-col-lg-3  sc-p-b--l sc-p-b-lg--0">
                      <span class="sc-ListItem sc-ListItem-l--iconTop sc-ListItem--withFeatureIcon u-lg-flexCol sc-m-b--l sc-m-b-lg--0">
                      <div class="sc-ListItem-label">
              <span class="sc-Icon sc-Icon--feature sc-Icon--primary-blue sc-Icon--secondary-grey-60 sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  aria-hidden="true" >

  <path class="sc-Icon--secondary-color" d="M24 40a16 16 0 0 1-2-32V0a24 24 0 1 0 17.5 42.2l-5.7-5.7A16 16 0 0 1 24 40"/>
  <path class="sc-Icon--primary-color" d="M39.9 22A16 16 0 0 0 26 8V0a24 24 0 0 1 21.9 22h-8zm0 4h8c-.4 5-2.4 9.7-5.6 13.4l-5.7-5.7A16 16 0 0 0 40 26z"/>
</svg>
</span>

              <h4>Smart Rebalancing</h4>
            </div>
            <div class="sc-ListItem-body">
              <p>We automatically rebalance your portfolio so you maintain an optimal level of risk.</p>
            </div>
                      </span>
                  </div>

        <div class="sc-ContentGrid-item sc-col-12 sc-col-md-6  sc-col-lg-3  sc-p-b--l sc-p-b-lg--0">
                      <span class="sc-ListItem sc-ListItem-l--iconTop sc-ListItem--withFeatureIcon u-lg-flexCol sc-m-b--l sc-m-b-lg--0">
                      <div class="sc-ListItem-label">
              <span class="sc-Icon sc-Icon--feature sc-Icon--primary-blue sc-Icon--secondary-grey-60 sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  aria-hidden="true" >

  <path class="sc-Icon--secondary-color" d="M10.2 4.3L7.8 0H24l-8.3 14-3-5.4C8.3 11.9 6 18 6 24a18 18 0 0 0 14.8 17.7l-3.1 5.4a24 24 0 0 1-7.5-42.8z"/>
  <path class="sc-Icon--primary-color" d="M48 24a24 24 0 0 1-10.2 19.7l2.4 4.3H24l8.3-14 3 5.4C39.7 36.1 42 30 42 24A18 18 0 0 0 27.2 6.3L30.3.9A24 24 0 0 1 48 24"/>
</svg>
</span>

              <h4>Auto-Depositing</h4>
            </div>
            <div class="sc-ListItem-body">
              <p>Set up auto-deposits and we’ll seamlessly transfer funds into your investment account.</p>
            </div>
                      </span>
                  </div>

        <div class="sc-ContentGrid-item sc-col-12 sc-col-md-6  sc-col-lg-3  sc-p-b--l sc-p-b-lg--0">
                      <span class="sc-ListItem sc-ListItem-l--iconTop sc-ListItem--withFeatureIcon u-lg-flexCol sc-m-b--l sc-m-b-lg--0">
                      <div class="sc-ListItem-label">
              <span class="sc-Icon sc-Icon--feature sc-Icon--primary-blue sc-Icon--secondary-grey-60 sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  aria-hidden="true" >

  <polygon class="sc-Icon--secondary-color" points="0 35 12.93 48 17.173 43.757 11.462 38 48 38 48 31.999 11.462 31.999 17.173 26.242 12.93 21.999"/>
  <polygon class="sc-Icon--primary-color" points="35.07 0 30.827 4.243 36.539 10 0 10 0 15.999 36.539 15.999 30.827 21.757 35.07 26 47.999 13"/>
</svg>
</span>

              <h4>Reinvesting Dividends</h4>
            </div>
            <div class="sc-ListItem-body">
              <p>Any dividends get reinvested immediately back into your portfolio—so you earn more.</p>
            </div>
                      </span>
                  </div>

                  <div class="sc-ContentGrid-item sc-col-12 sc-col-md-6  sc-col-lg-3  sc-p-b--l sc-p-b-lg--0">
                          <span class="sc-ListItem sc-ListItem-l--iconTop sc-ListItem--withFeatureIcon u-lg-flexCol sc-m-b--l sc-m-b-lg--0">
                          <div class="sc-ListItem-label">
                <span class="sc-Icon sc-Icon--feature sc-Icon--primary-blue sc-Icon--secondary-grey-60 sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  aria-hidden="true" >

  <path class="sc-Icon--secondary-color" d="M13.2 48l-.8-2.1a9 9 0 0 1-3 0l-1 2-3.6-1.6.9-2A9 9 0 0 1 3.6 42l-2.1.9L0 39.3l2-.9a9 9 0 0 1 .1-3l-2-.9L1.5 31l2 .8a9 9 0 0 1 2.2-2L5 27.5 8.7 26l.8 2h3l1-2 3.6 1.6-.9 2a9 9 0 0 1 2.1 2.2l2.1-.9 1.5 3.7-2 .9-.1 3 2 .9-1.5 3.6-2-.8a9 9 0 0 1-2.2 2l.8 2.1-3.7 1.5zm-6-9.5a4 4 0 1 0 7.5-3 4 4 0 0 0-7.5 3z"/>
  <path class="sc-Icon--primary-color" d="M48 19h-3.4c-.3 1.4-.9 2.6-1.6 3.8l2.4 2.4-4.3 4.2-2.3-2.3c-1.2.7-2.5 1.2-3.9 1.5V32h-6v-3.4c-1.3-.3-2.6-.8-3.8-1.5l-2.3 2.3-4.3-4.2 2.4-2.4c-.7-1.2-1.3-2.4-1.6-3.8H16v-6h3.4c.3-1.4.9-2.7 1.6-3.8l-2.4-2.4 4.3-4.2L25 4.9c1.2-.7 2.5-1.2 3.8-1.5V0h6v3.4c1.4.3 2.7.8 3.9 1.5L41 2.6l4.3 4.2L43 9.2c.7 1.2 1.3 2.4 1.6 3.8h3.3v6zm-16 4a7 7 0 1 0 0-14 7 7 0 0 0 0 14z"/>
</svg>
</span>

                <h4>Tax Loss Harvesting</h4>
              </div>
              <div class="sc-ListItem-body">
                <p>We check regularly for opportunities to lower your tax bill while still maintaining optimal asset allocation and expected returns.</p>
              </div>
                          </span>
                      </div>
              </div>
      
        </div>
    </div>
  </div>
</div>

      

<div class="sc-SectionLayout sc-p-v--l u-border-b" data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot ">
            
        </div>
    </div>
  </div>
</div>

      

<div class="sc-SectionLayout sc-SectionLayout--spacious sc-p-v--xxl " data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot ">
                      <div class="sc-ContentGrid u-flexJustifyCenter" data-behavior-fees-section>
  <div class="sc-ContentGrid-item u-col-9@md u-col-6@lg u-textCenter">
    <h2>You pay one low, annual&nbsp;fee.</h2>
    <p class="sc-m-b--m">No hidden fees. No additional trading and transfer fees. What you see is what you pay. If only everything in life were this simple. See&nbsp;details</p>
    <div class="u-brightSpacer u-brightSpacer--short u-flexExpandLeft u-flexExpandRight sc-m-b--xl"></div>
    <h4 class="sc-m-b--0">Annual Fee</h4>
    <div class="HugeNumber sc-m-b--s">
      <span class="u-superTitle HugeNumber-content sc-color-grey-60">0.25%</span>
    </div>
    <p>or about $25/year for every $10,000&nbsp;invested</p>
  </div>
</div>

      
        </div>
    </div>
  </div>
</div>

      

<div class="sc-SectionLayout sc-SectionLayout--spacious sc-backgroundColor-grey-10 " data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot ">
                      <div class="sc-ContentGrid u-flexJustifyBetween" data-behavior-get-started-action-cards>
  <div class="sc-ContentGrid-item u-col-12 u-col-5@md sc-m-b--l sc-m-b-md--0">
    <h2>How would you like to get&nbsp;started?</h2>
    <p>Your first step toward a smarter investing future starts&nbsp;here.</p>
  </div>
  <div class="sc-ContentGrid-item u-col-12 u-col-6@md">

    <div data-behavior-basic-signup-action-card onclick="location='app/get_started'">
      <div class="sc-Card ActionCard u-shadow-small sc-m-b--s">
  <div class="sc-Card-body u-flex u-flexJustifyBetween">
    <div class="sc-m-r-lg--m">
      <div class="sc-ListItem  sc-ListItem--condensed sc-ListItem--withUiIcon-m">
        <div class="sc-ListItem-label">
          <span class="sc-Icon sc-Icon--m sc-Icon--feature sc-Icon--primary-blue sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  aria-hidden="true" >

  <path class="sc-Icon--secondary-color" d="M0 48V24h10v24H0zm19 0V12h10v36H19z"/>
  <polygon class="sc-Icon--primary-color" points="38 48 48 48 48 0 38 0"/>
</svg>
</span>

          <h4>Create a Betterment account</h4>
        </div>
        <div class="sc-ListItem-body">
          <p class="u-secondaryText">Go ahead and join the smart, modern way to invest.</p>
        </div>
      </div>
    </div>
    <div class="u-flexAlignSelfCenter sc-m-l--m">
      <span class="sc-Icon sc-Icon--s sc-Icon--blue sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"  aria-hidden="true" >

  <polygon points="3.781 14.586 10.364 8.003 3.787 1.413 5.204 0 13.191 8.003 5.195 16"/>
</svg>
</span>

    </div>
  </div>
</div>
    </div>

    <div data-behavior-guidance-signup-action-card onclick="location='app/guidance'">
      <div class="sc-Card ActionCard u-shadow-small sc-m-b--s">
  <div class="sc-Card-body u-flex u-flexJustifyBetween">
    <div class="sc-m-r-lg--m">
      <div class="sc-ListItem  sc-ListItem--condensed sc-ListItem--withUiIcon-m">
        <div class="sc-ListItem-label">
          <span class="sc-Icon sc-Icon--m sc-Icon--feature sc-Icon--primary-blue sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  aria-hidden="true" >

  <path class="sc-Icon--secondary-color" d="M46 48a22 22 0 0 0-44 0h6a16 16 0 1 1 32 0h6z"/>
  <path class="sc-Icon--primary-color" d="M35 11a11 11 0 1 1-22 0 11 11 0 0 1 22 0"/>
</svg>
</span>

          <h4>See what we can do for you</h4>
        </div>
        <div class="sc-ListItem-body">
          <p class="u-secondaryText">Tell us a bit about yourself, and we'll show you the benefits of investing with&nbsp;us.</p>
        </div>
      </div>
    </div>
    <div class="u-flexAlignSelfCenter sc-m-l--m">
      <span class="sc-Icon sc-Icon--s sc-Icon--blue sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"  aria-hidden="true" >

  <polygon points="3.781 14.586 10.364 8.003 3.787 1.413 5.204 0 13.191 8.003 5.195 16"/>
</svg>
</span>

    </div>
  </div>
</div>
    </div>

    <div class="u-hidden" data-behavior-investing-review-action-card>
      <div class="sc-Card ActionCard u-shadow-small sc-m-b--s">
  <div class="sc-Card-body u-flex u-flexJustifyBetween">
    <div class="sc-m-r-lg--m">
      <div class="sc-ListItem  sc-ListItem--condensed sc-ListItem--withUiIcon-m">
        <div class="sc-ListItem-label">
          <span class="sc-Icon sc-Icon--m sc-Icon--feature sc-Icon--primary-blue sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  aria-hidden="true" >

  <path class="sc-Icon--secondary-color" d="M0 28v-8h8v8H0zm16 0v-8h32v8H16zM0 44v-8h8v8H0zm16 0v-8h32v8H16z"/>
  <path class="sc-Icon--primary-color" d="M0 12V4h8v8H0zm16 0V4h32v8H16z"/>
</svg>
</span>

          <h4>Get a free investing checkup</h4>
        </div>
        <div class="sc-ListItem-body">
          <p class="u-secondaryText">Help us get a sense of your investing approach and see how you could&nbsp;improve.</p>
        </div>
      </div>
    </div>
    <div class="u-flexAlignSelfCenter sc-m-l--m">
      <span class="sc-Icon sc-Icon--s sc-Icon--blue sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"  aria-hidden="true" >

  <polygon points="3.781 14.586 10.364 8.003 3.787 1.413 5.204 0 13.191 8.003 5.195 16"/>
</svg>
</span>

    </div>
  </div>
</div>
    </div>

   
      
        </div>
    </div>
  </div>
</div>

  
        </main>
      
<div id="search-modal" class="sc-Modal">
  <section class="sc-SectionLayout">
    <div class="sc-SectionLayout-contentWrapper">
      <div class="sc-Modal-container u-col-7@md u-col-5@lg">
        <div class="sc-Modal-close">
          <span class="sc-Icon sc-Icon--s">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-label="Close"  role="img">
&lt;title&gt;Close&lt;/title&gt;
  <polygon points="14.587 .001 8 6.588 1.413 .001 0 1.414 6.587 8.001 0 14.588 1.413 16 8 9.414 14.587 16 16 14.588 9.413 8.001 16 1.414"/>
</svg>
</span>

        </div>
        <div class="sc-Modal-content">
          <h2>Search our site</h2>
          <form novalidate id="search-modal-form" class="u-flex u-flexAlignItemsCenter" action="https://www.betterment.com/">
            <input id="search-modal-input" class="sc-m-b--0 sc-m-r--s" aria-labelledby="search-modal-submit" type="search" placeholder="Search for something" value="" name="s" />
            <input type="hidden" value="about-betterment" name="tab" data-search-results-active-tab-react-hack />
            <button id="search-modal-submit" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
      
<div id="extra-terms-placeholder"></div>


<?php
//adding footer file
include('footer.php');

?>


    </div>

<?php
//add scripts
include('scripts.php');

?>


</body>


</html>
