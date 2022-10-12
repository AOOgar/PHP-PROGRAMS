<!DOCTYPE html>

<html class="no-js" lang="en-US">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <title>Betterment | The Smart, Modern Way to Invest | Online Financial Advisor</title>
  <link rel="stylesheet" href="wp-content/themes/foley/release/foley.dec3179f02968900.css" type="text/css" media="screen" />

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel='shortlink' href='index.html' />
 

 <link rel="icon" href="wp-content/themes/foley/images/logos/site_icon_512.png" sizes="32x32" />
	
	<script type="text/javascript">(window.NREUM||(NREUM={})).loader_config={xpid:"UwYOWVBbGwYAVFZWBwA="};window.NREUM||(NREUM={}),__nr_require=function(t,n,e){function r(e){if(!n[e]){var o=n[e]={exports:{}};t[e][0].call(o.exports,function(n){var o=t[e][1][n];return r(o||n)},o,o.exports)}return n[e].exports}if("function"==typeof __nr_require)return __nr_require;for(var o=0;o<e.length;o++)r(e[o]);return r}({1:[function(t,n,e){function r(t){try{s.console&&console.log(t)}catch(n){}}var o,i=t("ee"),a=t(16),s={};try{o=localStorage.getItem("__nr_flags").split(","),console&&"function"==typeof console.log&&(s.console=!0,o.indexOf("dev")!==-1&&(s.dev=!0),o.indexOf("nr_dev")!==-1&&(s.nrDev=!0))}catch(c){}s.nrDev&&i.on("internal-error",function(t){r(t.stack)}),s.dev&&i.on("fn-err",function(t,n,e){r(e.stack)}),s.dev&&(r("NR AGENT IN DEVELOPMENT MODE"),r("flags: "+a(s,function(t,n){return t}).join(", ")))},{}],2:[function(t,n,e){function r(t,n,e,r,s){try{p?p-=1:o(s||new UncaughtException(t,n,e),!0)}catch(f){try{i("ierr",[f,c.now(),!0])}catch(d){}}return"function"==typeof u&&u.apply(this,a(arguments))}function UncaughtException(t,n,e){this.message=t||"Uncaught error with no additional information",this.sourceURL=n,this.line=e}function o(t,n){var e=n?null:c.now();i("err",[t,e])}var i=t("handle"),a=t(17),s=t("ee"),c=t("loader"),f=t("gos"),u=window.onerror,d=!1,l="nr@seenError",p=0;c.features.err=!0,t(1),window.onerror=r;try{throw new Error}catch(h){"stack"in h&&(t(8),t(7),"addEventListener"in window&&t(5),c.xhrWrappable&&t(9),d=!0)}s.on("fn-start",function(t,n,e){d&&(p+=1)}),s.on("fn-err",function(t,n,e){d&&!e[l]&&(f(e,l,function(){return!0}),this.thrown=!0,o(e))}),s.on("fn-end",function(){d&&!this.thrown&&p>0&&(p-=1)}),s.on("internal-error",function(t){i("ierr",[t,c.now(),!0])})},{}],3:[function(t,n,e){t("loader").features.ins=!0},{}],4:[function(t,n,e){function r(t){}if(window.performance&&window.performance.timing&&window.performance.getEntriesByType){var o=t("ee"),i=t("handle"),a=t(8),s=t(7),c="learResourceTimings",f="addEventListener",u="resourcetimingbufferfull",d="bstResource",l="resource",p="-start",h="-end",m="fn"+p,v="fn"+h,w="bstTimer",y="pushState",g=t("loader");g.features.stn=!0,t(6);var b=NREUM.o.EV;o.on(m,function(t,n){var e=t[0];e instanceof b&&(this.bstStart=g.now())}),o.on(v,function(t,n){var e=t[0];e instanceof b&&i("bst",[e,n,this.bstStart,g.now()])}),a.on(m,function(t,n,e){this.bstStart=g.now(),this.bstType=e}),a.on(v,function(t,n){i(w,[n,this.bstStart,g.now(),this.bstType])}),s.on(m,function(){this.bstStart=g.now()}),s.on(v,function(t,n){i(w,[n,this.bstStart,g.now(),"requestAnimationFrame"])}),o.on(y+p,function(t){this.time=g.now(),this.startPath=location.pathname+location.hash}),o.on(y+h,function(t){i("bstHist",[location.pathname+location.hash,this.startPath,this.time])}),f in window.performance&&(window.performance["c"+c]?window.performance[f](u,function(t){i(d,[window.performance.getEntriesByType(l)]),window.performance["c"+c]()},!1):window.performance[f]("webkit"+u,function(t){i(d,[window.performance.getEntriesByType(l)]),window.performance["webkitC"+c]()},!1)),document[f]("scroll",r,{passive:!0}),document[f]("keypress",r,!1),document[f]("click",r,!1)}},{}],5:[function(t,n,e){function r(t){for(var n=t;n&&!n.hasOwnProperty(u);)n=Object.getPrototypeOf(n);n&&o(n)}function o(t){s.inPlace(t,[u,d],"-",i)}function i(t,n){return t[1]}var a=t("ee").get("events"),s=t(19)(a,!0),c=t("gos"),f=XMLHttpRequest,u="addEventListener",d="removeEventListener";n.exports=a,"getPrototypeOf"in Object?(r(document),r(window),r(f.prototype)):f.prototype.hasOwnProperty(u)&&(o(window),o(f.prototype)),a.on(u+"-start",function(t,n){var e=t[1],r=c(e,"nr@wrapped",function(){function t(){if("function"==typeof e.handleEvent)return e.handleEvent.apply(e,arguments)}var n={object:t,"function":e}[typeof e];return n?s(n,"fn-",null,n.name||"anonymous"):e});this.wrapped=t[1]=r}),a.on(d+"-start",function(t){t[1]=this.wrapped||t[1]})},{}],6:[function(t,n,e){var r=t("ee").get("history"),o=t(19)(r);n.exports=r,o.inPlace(window.history,["pushState","replaceState"],"-")},{}],7:[function(t,n,e){var r=t("ee").get("raf"),o=t(19)(r),i="equestAnimationFrame";n.exports=r,o.inPlace(window,["r"+i,"mozR"+i,"webkitR"+i,"msR"+i],"raf-"),r.on("raf-start",function(t){t[0]=o(t[0],"fn-")})},{}],8:[function(t,n,e){function r(t,n,e){t[0]=a(t[0],"fn-",null,e)}function o(t,n,e){this.method=e,this.timerDuration=isNaN(t[1])?0:+t[1],t[0]=a(t[0],"fn-",this,e)}var i=t("ee").get("timer"),a=t(19)(i),s="setTimeout",c="setInterval",f="clearTimeout",u="-start",d="-";n.exports=i,a.inPlace(window,[s,"setImmediate"],s+d),a.inPlace(window,[c],c+d),a.inPlace(window,[f,"clearImmediate"],f+d),i.on(c+u,r),i.on(s+u,o)},{}],9:[function(t,n,e){function r(t,n){d.inPlace(n,["onreadystatechange"],"fn-",s)}function o(){var t=this,n=u.context(t);t.readyState>3&&!n.resolved&&(n.resolved=!0,u.emit("xhr-resolved",[],t)),d.inPlace(t,y,"fn-",s)}function i(t){g.push(t),h&&(x?x.then(a):v?v(a):(E=-E,O.data=E))}function a(){for(var t=0;t<g.length;t++)r([],g[t]);g.length&&(g=[])}function s(t,n){return n}function c(t,n){for(var e in t)n[e]=t[e];return n}t(5);var f=t("ee"),u=f.get("xhr"),d=t(19)(u),l=NREUM.o,p=l.XHR,h=l.MO,m=l.PR,v=l.SI,w="readystatechange",y=["onload","onerror","onabort","onloadstart","onloadend","onprogress","ontimeout"],g=[];n.exports=u;var b=window.XMLHttpRequest=function(t){var n=new p(t);try{u.emit("new-xhr",[n],n),n.addEventListener(w,o,!1)}catch(e){try{u.emit("internal-error",[e])}catch(r){}}return n};if(c(p,b),b.prototype=p.prototype,d.inPlace(b.prototype,["open","send"],"-xhr-",s),u.on("send-xhr-start",function(t,n){r(t,n),i(n)}),u.on("open-xhr-start",r),h){var x=m&&m.resolve();if(!v&&!m){var E=1,O=document.createTextNode(E);new h(a).observe(O,{characterData:!0})}}else f.on("fn-end",function(t){t[0]&&t[0].type===w||a()})},{}],10:[function(t,n,e){function r(t){var n=this.params,e=this.metrics;if(!this.ended){this.ended=!0;for(var r=0;r<d;r++)t.removeEventListener(u[r],this.listener,!1);if(!n.aborted){if(e.duration=a.now()-this.startTime,4===t.readyState){n.status=t.status;var i=o(t,this.lastSize);if(i&&(e.rxSize=i),this.sameOrigin){var c=t.getResponseHeader("X-NewRelic-App-Data");c&&(n.cat=c.split(", ").pop())}}else n.status=0;e.cbTime=this.cbTime,f.emit("xhr-done",[t],t),s("xhr",[n,e,this.startTime])}}}function o(t,n){var e=t.responseType;if("json"===e&&null!==n)return n;var r="arraybuffer"===e||"blob"===e||"json"===e?t.response:t.responseText;return h(r)}function i(t,n){var e=c(n),r=t.params;r.host=e.hostname+":"+e.port,r.pathname=e.pathname,t.sameOrigin=e.sameOrigin}var a=t("loader");if(a.xhrWrappable){var s=t("handle"),c=t(11),f=t("ee"),u=["load","error","abort","timeout"],d=u.length,l=t("id"),p=t(14),h=t(13),m=window.XMLHttpRequest;a.features.xhr=!0,t(9),f.on("new-xhr",function(t){var n=this;n.totalCbs=0,n.called=0,n.cbTime=0,n.end=r,n.ended=!1,n.xhrGuids={},n.lastSize=null,p&&(p>34||p<10)||window.opera||t.addEventListener("progress",function(t){n.lastSize=t.loaded},!1)}),f.on("open-xhr-start",function(t){this.params={method:t[0]},i(this,t[1]),this.metrics={}}),f.on("open-xhr-end",function(t,n){"loader_config"in NREUM&&"xpid"in NREUM.loader_config&&this.sameOrigin&&n.setRequestHeader("X-NewRelic-ID",NREUM.loader_config.xpid)}),f.on("send-xhr-start",function(t,n){var e=this.metrics,r=t[0],o=this;if(e&&r){var i=h(r);i&&(e.txSize=i)}this.startTime=a.now(),this.listener=function(t){try{"abort"===t.type&&(o.params.aborted=!0),("load"!==t.type||o.called===o.totalCbs&&(o.onloadCalled||"function"!=typeof n.onload))&&o.end(n)}catch(e){try{f.emit("internal-error",[e])}catch(r){}}};for(var s=0;s<d;s++)n.addEventListener(u[s],this.listener,!1)}),f.on("xhr-cb-time",function(t,n,e){this.cbTime+=t,n?this.onloadCalled=!0:this.called+=1,this.called!==this.totalCbs||!this.onloadCalled&&"function"==typeof e.onload||this.end(e)}),f.on("xhr-load-added",function(t,n){var e=""+l(t)+!!n;this.xhrGuids&&!this.xhrGuids[e]&&(this.xhrGuids[e]=!0,this.totalCbs+=1)}),f.on("xhr-load-removed",function(t,n){var e=""+l(t)+!!n;this.xhrGuids&&this.xhrGuids[e]&&(delete this.xhrGuids[e],this.totalCbs-=1)}),f.on("addEventListener-end",function(t,n){n instanceof m&&"load"===t[0]&&f.emit("xhr-load-added",[t[1],t[2]],n)}),f.on("removeEventListener-end",function(t,n){n instanceof m&&"load"===t[0]&&f.emit("xhr-load-removed",[t[1],t[2]],n)}),f.on("fn-start",function(t,n,e){n instanceof m&&("onload"===e&&(this.onload=!0),("load"===(t[0]&&t[0].type)||this.onload)&&(this.xhrCbStart=a.now()))}),f.on("fn-end",function(t,n){this.xhrCbStart&&f.emit("xhr-cb-time",[a.now()-this.xhrCbStart,this.onload,n],n)})}},{}],11:[function(t,n,e){n.exports=function(t){var n=document.createElement("a"),e=window.location,r={};n.href=t,r.port=n.port;var o=n.href.split("://");!r.port&&o[1]&&(r.port=o[1].split("index.html")[0].split("@").pop().split(":")[1]),r.port&&"0"!==r.port||(r.port="https"===o[0]?"443":"80"),r.hostname=n.hostname||e.hostname,r.pathname=n.pathname,r.protocol=o[0],"/"!==r.pathname.charAt(0)&&(r.pathname="/"+r.pathname);var i=!n.protocol||":"===n.protocol||n.protocol===e.protocol,a=n.hostname===document.domain&&n.port===e.port;return r.sameOrigin=i&&(!n.hostname||a),r}},{}],12:[function(t,n,e){function r(){}function o(t,n,e){return function(){return i(t,[f.now()].concat(s(arguments)),n?null:this,e),n?void 0:this}}var i=t("handle"),a=t(16),s=t(17),c=t("ee").get("tracer"),f=t("loader"),u=NREUM;"undefined"==typeof window.newrelic&&(newrelic=u);var d=["setPageViewName","setCustomAttribute","setErrorHandler","finished","addToTrace","inlineHit","addRelease"],l="api-",p=l+"ixn-";a(d,function(t,n){u[n]=o(l+n,!0,"api")}),u.addPageAction=o(l+"addPageAction",!0),u.setCurrentRouteName=o(l+"routeName",!0),n.exports=newrelic,u.interaction=function(){return(new r).get()};var h=r.prototype={createTracer:function(t,n){var e={},r=this,o="function"==typeof n;return i(p+"tracer",[f.now(),t,e],r),function(){if(c.emit((o?"":"no-")+"fn-start",[f.now(),r,o],e),o)try{return n.apply(this,arguments)}catch(t){throw c.emit("fn-err",[arguments,this,t],e),t}finally{c.emit("fn-end",[f.now()],e)}}}};a("actionText,setName,setAttribute,save,ignore,onEnd,getContext,end,get".split(","),function(t,n){h[n]=o(p+n)}),newrelic.noticeError=function(t){"string"==typeof t&&(t=new Error(t)),i("err",[t,f.now()])}},{}],13:[function(t,n,e){n.exports=function(t){if("string"==typeof t&&t.length)return t.length;if("object"==typeof t){if("undefined"!=typeof ArrayBuffer&&t instanceof ArrayBuffer&&t.byteLength)return t.byteLength;if("undefined"!=typeof Blob&&t instanceof Blob&&t.size)return t.size;if(!("undefined"!=typeof FormData&&t instanceof FormData))try{return JSON.stringify(t).length}catch(n){return}}}},{}],14:[function(t,n,e){var r=0,o=navigator.userAgent.match(/Firefox[\/\s](\d+\.\d+)/);o&&(r=+o[1]),n.exports=r},{}],15:[function(t,n,e){function r(t,n){if(!o)return!1;if(t!==o)return!1;if(!n)return!0;if(!i)return!1;for(var e=i.split("."),r=n.split("."),a=0;a<r.length;a++)if(r[a]!==e[a])return!1;return!0}var o=null,i=null,a=/Version\/(\S+)\s+Safari/;if(navigator.userAgent){var s=navigator.userAgent,c=s.match(a);c&&s.indexOf("Chrome")===-1&&s.indexOf("Chromium")===-1&&(o="Safari",i=c[1])}n.exports={agent:o,version:i,match:r}},{}],16:[function(t,n,e){function r(t,n){var e=[],r="",i=0;for(r in t)o.call(t,r)&&(e[i]=n(r,t[r]),i+=1);return e}var o=Object.prototype.hasOwnProperty;n.exports=r},{}],17:[function(t,n,e){function r(t,n,e){n||(n=0),"undefined"==typeof e&&(e=t?t.length:0);for(var r=-1,o=e-n||0,i=Array(o<0?0:o);++r<o;)i[r]=t[n+r];return i}n.exports=r},{}],18:[function(t,n,e){n.exports={exists:"undefined"!=typeof window.performance&&window.performance.timing&&"undefined"!=typeof window.performance.timing.navigationStart}},{}],19:[function(t,n,e){function r(t){return!(t&&t instanceof Function&&t.apply&&!t[a])}var o=t("ee"),i=t(17),a="nr@original",s=Object.prototype.hasOwnProperty,c=!1;n.exports=function(t,n){function e(t,n,e,o){function nrWrapper(){var r,a,s,c;try{a=this,r=i(arguments),s="function"==typeof e?e(r,a):e||{}}catch(f){l([f,"",[r,a,o],s])}u(n+"start",[r,a,o],s);try{return c=t.apply(a,r)}catch(d){throw u(n+"err",[r,a,d],s),d}finally{u(n+"end",[r,a,c],s)}}return r(t)?t:(n||(n=""),nrWrapper[a]=t,d(t,nrWrapper),nrWrapper)}function f(t,n,o,i){o||(o="");var a,s,c,f="-"===o.charAt(0);for(c=0;c<n.length;c++)s=n[c],a=t[s],r(a)||(t[s]=e(a,f?s+o:o,i,s))}function u(e,r,o){if(!c||n){var i=c;c=!0;try{t.emit(e,r,o,n)}catch(a){l([a,e,r,o])}c=i}}function d(t,n){if(Object.defineProperty&&Object.keys)try{var e=Object.keys(t);return e.forEach(function(e){Object.defineProperty(n,e,{get:function(){return t[e]},set:function(n){return t[e]=n,n}})}),n}catch(r){l([r])}for(var o in t)s.call(t,o)&&(n[o]=t[o]);return n}function l(n){try{t.emit("internal-error",n)}catch(e){}}return t||(t=o),e.inPlace=f,e.flag=a,e}},{}],ee:[function(t,n,e){function r(){}function o(t){function n(t){return t&&t instanceof r?t:t?c(t,s,i):i()}function e(e,r,o,i){if(!l.aborted||i){t&&t(e,r,o);for(var a=n(o),s=m(e),c=s.length,f=0;f<c;f++)s[f].apply(a,r);var d=u[g[e]];return d&&d.push([b,e,r,a]),a}}function p(t,n){y[t]=m(t).concat(n)}function h(t,n){var e=y[t];if(e)for(var r=0;r<e.length;r++)e[r]===n&&e.splice(r,1)}function m(t){return y[t]||[]}function v(t){return d[t]=d[t]||o(e)}function w(t,n){f(t,function(t,e){n=n||"feature",g[e]=n,n in u||(u[n]=[])})}var y={},g={},b={on:p,addEventListener:p,removeEventListener:h,emit:e,get:v,listeners:m,context:n,buffer:w,abort:a,aborted:!1};return b}function i(){return new r}function a(){(u.api||u.feature)&&(l.aborted=!0,u=l.backlog={})}var s="nr@context",c=t("gos"),f=t(16),u={},d={},l=n.exports=o();l.backlog=u},{}],gos:[function(t,n,e){function r(t,n,e){if(o.call(t,n))return t[n];var r=e();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(t,n,{value:r,writable:!0,enumerable:!1}),r}catch(i){}return t[n]=r,r}var o=Object.prototype.hasOwnProperty;n.exports=r},{}],handle:[function(t,n,e){function r(t,n,e,r){o.buffer([t],r),o.emit(t,n,e)}var o=t("ee").get("handle");n.exports=r,r.ee=o},{}],id:[function(t,n,e){function r(t){var n=typeof t;return!t||"object"!==n&&"function"!==n?-1:t===window?0:a(t,i,function(){return o++})}var o=1,i="nr@id",a=t("gos");n.exports=r},{}],loader:[function(t,n,e){function r(){if(!E++){var t=x.info=NREUM.info,n=p.getElementsByTagName("script")[0];if(setTimeout(u.abort,3e4),!(t&&t.licenseKey&&t.applicationID&&n))return u.abort();f(g,function(n,e){t[n]||(t[n]=e)}),c("mark",["onload",a()+x.offset],null,"api");var e=p.createElement("script");e.src="https://"+t.agent,n.parentNode.insertBefore(e,n)}}function o(){"complete"===p.readyState&&i()}function i(){c("mark",["domContent",a()+x.offset],null,"api")}function a(){return O.exists&&performance.now?Math.round(performance.now()):(s=Math.max((new Date).getTime(),s))-x.offset}var s=(new Date).getTime(),c=t("handle"),f=t(16),u=t("ee"),d=t(15),l=window,p=l.document,h="addEventListener",m="attachEvent",v=l.XMLHttpRequest,w=v&&v.prototype;NREUM.o={ST:setTimeout,SI:l.setImmediate,CT:clearTimeout,XHR:v,REQ:l.Request,EV:l.Event,PR:l.Promise,MO:l.MutationObserver};var y=""+location,g={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net",agent:"js-agent.newrelic.com/nr-1099.min.js"},b=v&&w&&w[h]&&!/CriOS/.test(navigator.userAgent),x=n.exports={offset:s,now:a,origin:y,features:{},xhrWrappable:b,userAgent:d};t(12),p[h]?(p[h]("DOMContentLoaded",i,!1),l[h]("load",r,!1)):(p[m]("onreadystatechange",o),l[m]("onload",r)),c("mark",["firstbyte",s],null,"api");var E=0,O=t(18)},{}]},{},["loader",2,10,4,3]);</script>
    <link rel="apple-touch-icon-precomposed" href="favicon-152.png">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
        <script type="text/javascript">
        window.TT = "eyJyZWdpc3RyeSI6eyJtb2JpbGVfZ29hbF9wcm9qZWN0aW9uc19xMl8yMDE4X3NhZmVfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2FnZ3JlZ2F0aW9uX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiZ29hbHNfcGhhc2Vfb25lXzIwMTYiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImV4dGVybmFsX2FjY291bnRfdHJhbnNmZXJfcHJldmlld19xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9mb3JjZWRfd2Fsa3Rocm91Z2hfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXdhcmRzX2NlbnRlcl9xMl8yMDE4X2VuYWJsZWQiOnsiZmFsc2UiOjAsInRydWUiOjEwMH0sImFsbG9jYXRpb25fcmV2aWV3X3JlZmFjdG9yX2dvYWxfY3JlYXRpb25fcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJjb21wb25lbnRfcmV2ZXJzYWxzX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInBvcnRmb2xpb191cGdyYWRlX21lc3NhZ2luZ19xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJvbGxvdmVyX3NwbGFzaF9wYWdlX3JlZGVzaWduX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwib2ZmZXJzX3Nob3dfcGFnZV9xMl8yMDE4X2VuYWJsZWQiOnsiZmFsc2UiOjAsInRydWUiOjEwMH0sInJldGFpbF9jcHJfemVuZGVza193ZWJfd2lkZ2V0X3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiZXh0ZXJuYWxfYWNjb3VudF90cmFuc2Zlcl9wcmV2aWV3X3EyXzIwMThfZXhwZXJpbWVudCI6eyJ0cmVhdG1lbnQiOjUwLCJjb250cm9sIjo1MH0sImI0YV9yYWlsc19zaWdudXBfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiaW5fYXBwX2d1aWRlX2Rlc2lnbl8yMDE2X3EzIjp7ImNvbnRyb2wiOjEwMCwibmV3X2Rlc2lnbiI6MH0sInJldGFpbF9jaGFybGllX21lZGlhX2Rlc3RpbmF0aW9uX3Rlc3RfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYjRhX3N1Yl9hY2NvdW50X2RhdGEiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImI0YV9wb3J0Zm9saW9fc3RyYXRlZ2llcyI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwic3ViX2FjY291bnRfcG93ZXJlZF9hZHZpc29yX2Rhc2hib2FyZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibm92ZW1iZXJfMjAxNl9wcm9tb19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjM0LCJoaWdoIjozMywibG93IjozM30sIm1vYmlsZV9mb3JjZWRfd2Fsa3Rocm91Z2hfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwicm9sbG92ZXJfcmVkZXNpZ25lZF90cmFuc2Zlcl9wcmV2aWV3X3EyXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudCI6MH0sImFsbG9jYXRpb25fcmV2aWV3X3JlZmFjdG9yX2dvYWxfY3JlYXRpb25fcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsImV4cGVyaW1lbnQiOjEwMH0sInJldGFpbF9jcHJfemVuZGVza193ZWJfd2lkZ2V0X3EyXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sImZvdXJfb2hfb25lX2tfcm9sbG92ZXJfaW5zdHJ1Y3Rpb25zX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2lvc19maXhfcXVvdm9fY29ubmVjdGlvbnNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfcmV3YXJkc19jZW50ZXJfcTFfMjAxOV9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwidGF4X3llYXJfbWF4X291dF9xMV8yMDE5X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImJhc2ljX3NpZ251cF9mbG93X2NvbnRpbnVlX3NwaW5uZXJfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibW9iaWxlX2dvYWxfcHJvamVjdGlvbnNfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX3dlYl9wYWxzX2Rlc3RpbmF0aW9uX3Rlc3RfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYWxsb2NhdGlvbl9yZXZpZXdfcmVmYWN0b3JfZXhpc3RpbmdfZ29hbF9xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF90b19iNGFfZXZlbnRzX2Rpc2FibGVkIjp7ImZhbHNlIjoxMDAsInRydWUiOjB9LCJwZXJmb3JtYW5jZV9wYWdlX2phdmFzY3JpcHRfcmVmYWN0b3JfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJnb2FsX3JlY29tbWVuZGF0aW9uX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiYWR2aXNvcl9qb2ludF9hY2NvdW50X2dvYWxfY3JlYXRpb25fcTJfMjAxOF9lbmFibGVkIjp7ImZhbHNlIjowLCJ0cnVlIjoxMDB9LCJyZXRhaWxfaXJhX3JvbGxvdmVyX3BpenphX3RyYWNrZXJfcTJfMjAxOF9lbmFibGVkIjp7ImZhbHNlIjoxMDAsInRydWUiOjB9LCJ1YmVyX3NpZ251cF9mbG93X2RlcHJlY2F0aW9uX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInRlbnVyZWRfYXV0b21hdGljX2RlcG9zaXRfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX2VtcG93ZXJpbmdfbWVkaWFfZGVzdGluYXRpb25fdGVzdF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJkYXkwX2VtYWlsX3E0XzIwMTZfZXhwZXJpbWVudCI6eyJ0cnVlIjo1MCwiZmFsc2UiOjUwfSwibW9iaWxlX2F1dG9fd2Fsa3Rocm91Z2hfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfYXV0b21hdGljX3JvbGxvdmVyX2NoZWNrX2RlcG9zaXRfcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyb2xsb3Zlcl9jb21wbGV0ZV90Y3BfYWR2aWNlX3ExXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9hZ2dyZWdhdGlvbl9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfbmVyZF93YWxsZXRfZGVzdGluYXRpb25fdGVzdF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJkYXkwX2VtYWlsX3YyX3ExXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImFsbG9jYXRpb25fcmV2aWV3X3JlZmFjdG9yX2V4aXN0aW5nX2dvYWxfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsImV4cGVyaW1lbnQiOjEwMH0sImRheTBfZW1haWxfdjNfcTFfMjAxN19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwicG9zdF9zaWdudXBfZnJlZV9jYWxsX3ExXzIwMTciOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJsZWdhbF9hY2NvdW50c19vdXRzaWRlX29mX3NwYV9xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF9nZXRfc3RhcnRlZF9vcHRpb25zX3EzXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJiYXNpY19zaWdudXBfbmV3X2NvcHlfdHJlYXRtZW50IjowLCJiYXNpY19zaWdudXBfbmV3X2NvcHlfYW5kX2dvYWxfc2VsZWN0aW9uX3RyZWF0bWVudCI6MTAwfSwibW9iaWxlX2V2ZXJ5ZGF5X3NpZ251cF9xM18yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJtb2JpbGVfYXV0b193YWxrdGhyb3VnaF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJtb2JpbGVfYW5kcm9pZF9maXhfcXVvdm9fY29ubmVjdGlvbnNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJ0ZW51cmVkX2F1dG9tYXRpY19kZXBvc2l0X3EzXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3NtYXJ0X3NhdmVyX2luX2dvYWxfc2VsZWN0aW9uX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImI0Yl9jb250cmlidXRpb25fc291cmNlX2JyZWFrZG93bl9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJiNGJfb25ib2FyZGluZ19mbG93X291dHNpZGVfc3BhIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtYXJjaF9tb250aGx5X2VtYWlsX3JlY2VpdmVkIjp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibWFyY2hfbW9udGhseV9lbWFpbF9yZWNlaXZlZF93aXRoX2N0YSI6eyJzaW5nbGVfY3RhIjo1MCwiZG91YmxlX2N0YSI6NTB9LCJkZWNvbnZlcnNpb25fcmVwb3J0c19nZW5lcmFibGUiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm9mZl90cmFja19nb2FsX3Rhc2tfcTFfMjAxN19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwicHJpY2luZ19wbGFuX3NpZ251cF9pbnZlc3RhYmxlX2Fzc2V0c192YWx1ZV9pbnB1dF8yMDE3Ijp7InJhZGlvIjowLCJ2YWx1ZSI6MTAwfSwiZGF5MF9lbWFpbF9kZWxpdmVyeV90aW1lX3ExXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImJyb2NodXJlX3plbmRlc2tfdGFsa19xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJyZXRhaWxfbGlzdGVuX21vbmV5X21hdHRlcnNfZGVzdGluYXRpb25fdGVzdF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJpbmNsdWRlX2FkdmljZV9pbl9xdWFydGVybHlfc3RhdGVtZW50X3ExXzIwMTciOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJiNGFfZ29hbF9zdGF0dXNfZGlzYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImZvcm1fcmVkZXNpZ25fZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX2V2ZXJ5ZGF5X3NpZ251cF9xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInBlcmZvcm1hbmNlX3BhZ2VfaW1wcm92ZW1lbnRzX3EzXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV3YXJkc19jZW50ZXJfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwibW9iaWxlX2dyYXBoaW5nX3E0XzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9ncmFwaGluZ192Ml9xNF8yMDE3X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfaW52ZXN0b3BlZGlhX2Rlc3RpbmF0aW9uX3Rlc3RfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYjRiX3JlYWN0X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm1vYmlsZV9vdXRzbWFydF9hdmVyYWdlX2hvbWVfc2NyZWVuX3EzXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX291dHNtYXJ0X2F2ZXJhZ2VfaG9tZV9zY3JlZW5fcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwicmV0YWlsX3VuZnVuZGVkX3NpbmdsZV9kZXBvc2l0X3E0XzIwMThfb2ZmZXJfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF9zbWFydF9zYXZlcl9pbl9nb2FsX3NlbGVjdGlvbl9xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF80MDFrX3doaXRlX2dsb3ZlX3JvbGxvdmVyX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9hbmRyb2lkX3Jld2FyZHNfY2VudGVyX3ExXzIwMTlfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiZ2Fpbl9sb3NzX3JlcG9ydHNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfZ2VuZXJhbF9hZmZpbGlhdGVfZGVzdGluYXRpb25fdGVzdF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJ1bmZ1bmRlZF93ZWxjb21lX3Nlcmllc19maXJzdF93ZWVrX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImZ1bmRlZF93ZWxjb21lX3Nlcmllc19jYW1wYWlnbl9xM18yMDE3X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAsInRyZWF0bWVudCI6OTB9LCJtb2JpbGVfaW5pdGlhbF9vbmVfdGltZV9kZXBvc2l0X3EyXzIwMTdfZW5hYmxlZCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sImludGVncmF0aW9uX2Vycm9yX2Rpc3BsYXlfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwicmV0YWlsX3R3b193YXlfc3dlZXBfcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtaW50X3RyYW5zYWN0aW9uc19xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9nb2FsX2ZhYl9xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJyZXRhaWxfdGVudXJlZF9zbWFydF9zYXZlcl9wcm9tb19zaXhfbW9udGhzX3EzXzIwMThfZW5yb2xsbWVudF9jcmVhdGlvbl9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfdGVudXJlZF9zbWFydF9zYXZlcl9wcm9tb190aHJlZV9tb250aHNfcTNfMjAxOF9lbnJvbGxtZW50X2NyZWF0aW9uX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF9maXJzdF9yZWZlcnJhbF9lbWFpbF9xM18yMDE4X3YyX2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJhcHBfZ3VpZGVfdmlzdWFsX3EyXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjozNCwic2luZ2xlX3Rhc2siOjMzLCJ0aHJlZV90YXNrIjozM30sImRpcmVjdF9tYWlsX2Z1bmRpbmdfcmVtaW5kZXJfcTJfMjAxN19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX2VtYWlsX3N0ZXBfZnJhbWluZ190cmlhbGluZ19xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJyZXRhaWxfd2hpdGVfZ2xvdmVfaXJhX3JvbGxvdmVyc19xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImI0YV9hZHZpc29yX3RydXN0X2NyZWF0aW9uX3EzXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiZXh0ZXJuYWxfYWNjb3VudF9vdmVycmlkZW5feWllbGRfcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJhcHBfZ3VpZGVfdmlzdWFsX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJzaW5nbGVfdGFzayI6NTAsInRocmVlX3Rhc2siOjUwfSwicTFfMjAxN19jb21wbGlhbmNlX3N0YXRlX3RheF9ub3RpZmljYXRpb25fZWxpZ2libGUiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF9zbWFydF9zYXZlcl9pbl9ndWlkZWRfc2lnbnVwX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImRyX3BlcnNvbmFsX3JlZmVycmFsX2NyZWF0aW9uX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInVuZnVuZGVkX3dlbGNvbWVfc2VyaWVzX2NhbXBhaWduX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMCwidHJlYXRtZW50Ijo5MH0sIm1vYmlsZV9zdW1tYXJ5X2RlcG9zaXRfYnV0dG9uX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sInJldGFpbF93ZWxjb21lX3NjcmVlbl9zbWFydF9zYXZlcl9xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfYXBwX2RheV83X3VuZnVuZGVkX3NpbmdsZV9kZXBvc2l0X29mZmVyX2Vucm9sbG1lbnRfam9iX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF9pbl9hcHBfZ3VpZGVfZXh0cmFfdGFza3NfcTRfMjAxOF92Ml9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwidHdvX3dheV9zd2VlcF9ib3VuZF9hZGp1c3RtZW50X3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3Nob3dfYWNhdF9jdGFfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfZ2V0X3N0YXJ0ZWRfZmluYW5jaWFsX3BsYW5fcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50X2d1aWRlZF9zaWdudXBfb25seSI6MCwidHJlYXRtZW50X2ZpbmFuY2lhbF9wbGFuX29ubHkiOjAsInRyZWF0bWVudF9maW5hbmNpYWxfcGxhbl9hbHQiOjB9LCJ0ZW51cmVkX3RheF95ZWFyX21heF9vdXRfcTFfMjAxOV9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX2xlZ2FsX2FjY291bnRfaW5fYmFzaWNfc2lnbnVwX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF90d29fdGFza3NfaW5fYXBwX2d1aWRlX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX2RlZmluZV9pbnZlc3RhYmxlX2Fzc2V0c19xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJtb2JpbGVfZGVtb19tb2RlX3EyXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudCI6MH0sIm1vYmlsZV9ub3RoaW5nX3ExXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9vdXRzbWFydF9hdmVyYWdlX2hvbWVfc2NyZWVuX3EzXzIwMThfdjJfZW5hYmxlZCI6eyJmYWxzZSI6MTAwLCJ0cnVlIjowfSwiYnJvY2h1cmVfcmVhY3Rfc3dpdGNoaW5nX2Nvc3RfY2FsY3VsYXRvcl9xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF93aGl0ZV9nbG92ZV9pcmFfcm9sbG92ZXJzX3EzXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJlZmVyX2FfZnJpZW5kX3YyX2VuYWJsZWQiOnsiZmFsc2UiOjEwMCwidHJ1ZSI6MH0sImI0YV9oaWdoX3ByaW9yaXR5X25vdGlmaWNhdGlvbl9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwiYWRkX2dvYWwiOjAsInRheGFibGVfYWNhdHMiOjAsImRpZ2l0YWxfcm9sbG92ZXJfdXBkYXRlIjowLCJ0YXhfd2l0aGhvbGRpbmciOjAsImpvaW50X2FjY291bnQiOjAsInJvbGxvdmVyIjowfSwicmV0YWlsX3RlbnVyZWRfc21hcnRfc2F2ZXJfcHJvbW9fdjJfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50X3RocmVlX21vbnRocyI6MCwidHJlYXRtZW50X3NpeF9tb250aHMiOjB9LCJtb2JpbGVfZGVtb19tb2RlX3ExXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9pbnZlc3RlZF9ncmFwaF9xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJuYXZpZ2F0aW9uX3NpZGViYXJfdXBkYXRlc19xM18yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJtb2JpbGVfcXVvdm9fYmFua19saW5raW5nX3EzXzIwMThfZW5hYmxlZCI6eyJmYWxzZSI6MCwidHJ1ZSI6MTAwfSwibmF2aWdhdGlvbl9zaWRlYmFyX3VwZGF0ZXNfcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfYXBwX25hdl9lYXJuX3Jld2FyZHNfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwiYjRhX25hdmlnYXRpb25fcmVhcmNoaXRlY3R1cmVfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfb3V0c21hcnRfYXZlcmFnZV9ob21lX3NjcmVlbl9xM18yMDE4X3YyX2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJtb2JpbGVfaW9zX3R3b193YXlfc3dlZXBfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfdGF4X3RpbWVfbmF2X2l0ZW1fcTFfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwicmV0YWlsX3RlbnVyZWRfc21hcnRfc2F2ZXJfcHJvbW9fdjJfcTNfMjAxOF9nYXRlX2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJtb2JpbGVfc2lnbnVwX2NvcHlfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwibW9iaWxlX3F1b3ZvX2JhbmtfbGlua2luZ19xM18yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJicm9jaHVyZV9ob21lcGFnZV9kZXNrdG9wX21hZ2dpZV9oZXJvX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF90d29fdGFza3NfaW5fYXBwX2d1aWRlX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImRlZmF1bHRfZ29hbHNfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX3Nob3dfYWNhdF9jdGFfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0aXJlX2d1aWRlX3NldHVwX3NwZW5kaW5nX3N0ZXBfcTRfMjAxN19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYnJvY2h1cmVfbW9iaWxlX21hZ2dpZV9oZXJvX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImJyb2NodXJlX21vYmlsZV9uYXZfYjJiX2xpbmtzX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImI0YV9iNGJfZGVmYXVsdF9nb2Fsc19xNF8yMDE4X2VuYWJsZWQiOnsiZmFsc2UiOjEwMCwidHJ1ZSI6MH0sIm1vYmlsZV9pb3NfcmV3YXJkc19jZW50ZXJfcTFfMjAxOV9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtb2JpbGVfYW5kcm9pZF90d29fd2F5X3N3ZWVwX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3R3b193YXlfc3dlZXBfY2FuY2VsYWJsZV90cmFuc2FjdGlvbnNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtb2JpbGVfaW9zX3N1bW1hcnlfZmFiX3EyXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9nb2FsX2dyYXBoX3ExXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJlY29tbWVuZGVkX3RheF9zdHJhdGVnaWVzX3NpZ251cF9xM18yMDE3X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJwcm94eV90aWNrZXJzX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwicmV0YWlsX2luX2FwcF9ndWlkZV9leHRyYV90YXNrc19xNF8yMDE4X3YyX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9nb2FsX3Byb2plY3Rpb25zX3EyXzIwMThfc2FmZV9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwiYjRhX3Nob3dfYmFsYW5jZXNfY2xpZW50X2luZGV4X3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX2hpZ2hfbGV2ZWxfZmluYW5jaWFsX3BsYW5fYnV0dG9uX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudF9maW5hbmNpYWxfcGxhbiI6MCwidHJlYXRtZW50X2FkZF9nb2FsIjowfSwiam9pbnRfYWNjb3VudF9zaWdudXBfaW50ZW50X3F1ZXN0aW9uX2VuYWJsZWQiOnsidHJ1ZSI6NTAsImZhbHNlIjo1MH0sInF1b3ZvX3JlZnJlc2hpbmdfcmVnYXJkbGVzc19vZl9mdW5kaW5nX2VuYWJsZWQiOnsidHJ1ZSI6NTAsImZhbHNlIjo1MH0sImpvaW50X2FjY291bnRfc2lnbnVwX2ludGVudF9xdWVzdGlvbl92Ml9lbmFibGVkIjp7ImZhbHNlIjowLCJ0cnVlIjoxMDB9LCJyb2xsb3Zlcl9wcm9tb3Rpb25fMjAxNl9xMl9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJkb2N1bWVudF92YXVsdF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJ0ZW51cmVkX3JvbGxvdmVyX3Byb21vX3ExXzIwMTlfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF9sZWdhbF9hY2NvdW50X2luX2Jhc2ljX3NpZ251cF9xNF8yMDE4X2VuYWJsZWQiOnsiZmFsc2UiOjAsInRydWUiOjEwMH0sInJldGFpbF9jYXNoX2FuYWx5c2lzX3dpdGhvdXRfc21hcnRfc2F2ZXJfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfdHJhbnNmZXJfaW1wcm92ZW1lbnRfYWNhdHNfZmxvd19xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImZsZXhpYmxlX3BvcnRmb2xpb19jb21tb2RpdGllc19lbmFibGVkX3E0XzIwMTgiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImRpZ2l0YWxfZHVwbGljYXRlX3N0YXRlbWVudHNfZm9yX2twbWdfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiZGlnaXRhbF9kdXBsaWNhdGVfc3RhdGVtZW50c19mb3Jfc3BfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiZGlnaXRhbF9kdXBsaWNhdGVfc3RhdGVtZW50c19mb3JfcHdjX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImRpZ2l0YWxfZHVwbGljYXRlX3N0YXRlbWVudHNfZm9yX2RlbG9pdHRlX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImRpZ2l0YWxfZHVwbGljYXRlX3N0YXRlbWVudHNfZm9yX2V5X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInNlbmRfaWRvbG9neV9lbWFpbF9xNF8yMDE2X2VuYWJsZWQiOnsiZmFsc2UiOjAsInRydWUiOjEwMH0sImRyX3BvcnRmb2xpb19tYW5hZ2VtZW50X2FwaV9xMV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImFsbG9jYXRpb25fc2VsZWN0aW9uX3JlZmFjdG9yX3ExXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiYWR2aXNvcl9uZXR3b3JrX3E0XzIwMTZfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwidXBncmFkZV9wbGFuX3Rhc2tfcTFfMjAxN19lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJzcGVjaWFsaXplZF9lZGl0X2dvYWxfZXhwZXJpZW5jZV8yMDE2X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInBob25lX2FkdmljZV90YXNrX3E0XzIwMTZfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwicHVzaF9ub3RpZmljYXRpb25zX3ExXzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiZnVuZF90b191cGdyYWRlX3BsYW5fdGFza19xMV8yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6NTAsImZhbHNlIjo1MH0sInRoaXJ0eV9kYXlfZnJlZV90cmlhbF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJwb3J0Zm9saW9fbWFuYWdlbWVudF9hcGlfMjAxN19xNF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJiNGFfY29tcGxpYW5jZV9mZWVzXzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3plbmRlc2tfbHR2X3F1ZXVlX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF90cmFuc2Zlcl9pbXByb3ZlbWVudF9hY2F0c19mbG93X3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9ncmFwaGluZ19xNF8yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF9pbnZlc3RpbmdfYXNzZXNzbWVudF9jb25zdWx0YXRpb25fZW5hYmxlZCI6eyJmYWxzZSI6MTAwLCJ0cnVlIjowfSwidGF4X3llYXJfbWF4X291dF9xMV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInByaWNpbmdfcGxhbl9zaWdudXBfZmxvd19xMV8yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm1vYmlsZV9nb2FsX2ZhYl9xMV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImI0YV9hZGRfZ29hbF9ub3RpZmljYXRpb25fcTRfMjAxN19lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJhcHBfZ3VpZGVfdmlzdWFsX3EyXzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX21lc3NhZ2luZ19xM18yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImRpcmVjdF9tYWlsX2Z1bmRpbmdfcmVtaW5kZXJfcTJfMjAxN19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfbmF0aXZlX3NpZ251cF9xMl8yMDE3X2VuYWJsZWQiOnsiZmFsc2UiOjAsInRydWUiOjEwMH0sIm1vYmlsZV9zdW1tYXJ5X2RlcG9zaXRfYnV0dG9uX3EzXzIwMTdfZW5hYmxlZCI6eyJmYWxzZSI6MCwidHJ1ZSI6MTAwfSwicGhvbmVfbnVtYmVyX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInBlcmZvcm1hbmNlX3BhZ2VfaW1wcm92ZW1lbnRzX3EzXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sInExXzIwMTdfY29tcGxpYW5jZV9zdGF0ZV90YXhfbm90aWZpY2F0aW9uX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm1vYmlsZV9mcmVlX3RpbWVfcHJvbW9fcTNfMjAxN19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfZ29hbF9wcm9qZWN0aW9uc19xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInNkYV8xMDBrX2dhdGVfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfdGVudXJlZF9yb2xsb3Zlcl9kb2xsYXJzX21hbmFnZWRfZnJlZV9xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm1vYmlsZV9zaWdudXBfY29weV9xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImI0YV9hZHZpc29yX2ltcGVyc29uYXRpb25fbW9kYWxfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2dyYXBoaW5nX3YyX3E0XzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX2ludmVzdGVkX2dyYXBoX3ExXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiYWRkX3ByZWZlcnJlZF9tdW5pX2JvbmRfbG9jYWxlX3NlbGVjdGlvbl90b19kcl9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfZG9jdG9yX3JlYnJhbmRfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfYW1lcmljYW5fYWlybGluZXNfb2ZmZXJfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfaW9zX3N1bW1hcnlfZmFiX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiZHJfcGFwZXJsZXNzX2Rpc3RyaWJ1dGlvbl9lbGlnaWJpbGl0eV9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJiNGFfc2RhX3BvcnRmb2xpb3NfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJwb3J0Zm9saW9fbWFuYWdlbWVudF9nb2FsX3BvcnRmb2xpb18yMDE3X3E0X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInBsYW5fZmVlc19lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfdHJ1c3RlZF9jb250YWN0X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9nb2FsX2dyYXBoX3ExXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX2RlbW9fbW9kZV9xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm1vYmlsZV9ub3RoaW5nX3ExXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwic21vb2NoX2F1dG9fcmVzcG9uZGVyX3EzXzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiYmxhY2tyb2NrX2luY29tZV9wb3J0Zm9saW9fcTJfMjAxN19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfZGVmaW5lX2ludmVzdGFibGVfYXNzZXRzX3ExXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX2RlbW9fbW9kZV9xMV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF90cmFuc2Zlcl9pbXByb3ZlbWVudF9pcmFfbGlua19xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfdHJhbnNmZXJfaW1wcm92ZW1lbnRfdGF4YWJsZV9saW5rX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImRlZmF1bHRfZ29hbHNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfdHJhbnNmZXJfaW1wcm92ZW1lbnRfbWFuYWdlX3RyYW5zZmVyc19jdGFfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfdHJhbnNmZXJfaW1wcm92ZW1lbnRfbWFuYWdlX3RyYW5zZmVyc19zY3JlZW5fY3RhX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjoyNSwidHJlYXRtZW50XzEiOjI1LCJ0cmVhdG1lbnRfMiI6MjUsInRyZWF0bWVudF8zIjoyNX0sImZvdXJfb2hfb25lX2tfcm9sbG92ZXJfaW5zdHJ1Y3Rpb25zX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImI0YV9zZWNvbmRhcnlfYWR2aXNvcl9yZWZhY3Rvcl9xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF90cmFuc2Zlcl9pbXByb3ZlbWVudF9wYWdlX2xpbmtzX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX2d1aWRlZF9zaWdudXBfZGVidF9xdWVzdGlvbl9xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJyZXRhaWxfcTNfZml4X3F1b3ZvX2Nvbm5lY3Rpb25zX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH19LCJ1cmwiOiJodHRwczpcL1wvdHQuYmV0dGVybWVudC5jb20iLCJjb29raWVEb21haW4iOiJiZXR0ZXJtZW50LmNvbSIsImVuY29kZWRBdCI6IjIwMTgxMjE5MjIxNTIwIn0=";
    </script>
	
	

</head>

<body class="home page-template page-template-home page page-id-30 front-page sc-backgroundColor-grey-10 _tt">

  <div class="sc-SiteLayout sc-SiteLayout--constrained sc-backgroundColor-white" data-js-hook="SiteLayout">

    <div class="u-hidden sc-SectionLayout sc-SectionLayout--flush u-backgroundColor-blue-3"
      data-behavior-toast-message-toggle="">
      <div class="sc-SectionLayout-contentWrapper">
        <div class="ToastMessage">
          <div class="u-flex u-flexJustifyBetween u-flexAlignItemsCenter u-col-12 sc-p-v--m">
            <div class="u-flex u-flexAlignItemsCenter">
              <div class="u-hideUntilVisitorStateKnown" data-js-hook="referral_offer_q2_2018">
                <p class="sc-color-white sc-m-b--xxs">
                  <strong>Free for 30 days:</strong> Sign up now and get 30 days managed free after your first deposit.
                  <a class="u-knockout" href="referral-bonus">See&nbsp;offer&nbsp;details</a>
                </p>
              </div>
            </div>
            <a class="sc-m-l--m" href="javascript:void(0)" data-behavior-toast-message-dismiss="">
              <span class="sc-Icon sc-Icon--s sc-Icon--white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-label="Dismiss" role="img">
                  &lt;title&gt;Dismiss&lt;/title&gt;
                  <polygon points="14.587 .001 8 6.588 1.413 .001 0 1.414 6.587 8.001 0 14.588 1.413 16 8 9.414 14.587 16 16 14.588 9.413 8.001 16 1.414"></polygon>
                </svg>
              </span>

            </a>
          </div>
        </div>
      </div>
    </div>


   <?php
//add header file here
include('header.php');

    ?>

    <main class="sc-SiteLayout-main">


      <div class="" data-behavior-prospect-content="">
        <div class="sc-SectionLayout sc-p-b-md--xl sc-SectionLayout--transparentNavSibling sc-backgroundColor-black AnimatedMaggieLookingStraightAhead-md"
          data-js-hook="homepage-hero-section">
          <div class="sc-SectionLayout-contentWrapper sc-p-b-md--xl u-zeroZIndex">
            <div class="sc-ContentLayout ">
              <div class="sc-ContentSlot ">
                <div class="sc-p-v-md--xl">
                  <hgroup class="BigHero BigHero--leftFullBleed sc-m-b--0 sc-p-b--m">
                    <h1 class="BigHero-heading u-knockout u-textCenter u-md-textLeft ft-hero-heading"><span class="sc-color-blue">Hello,</span>
                       investor</h1>
                  </hgroup>
                  <div class="sc-col-6 u-displayNone--until-md">
                    <p class="u-knockout sc-m-b--l">We are SEC-registered investment advisor and betterment Securites, our broker-dealer, is a member of FINRA/SIPC.</p>
                  </div>
                  <div class="u-displayNone--md u-textCenter">
                    <p class="u-knockout sc-m-b--s">We are SEC-registered investment advisor and betterment Securites, our broker-dealer, is a member of FINRA/SIPC.</p>
                  <img src="./wp-content/themes/foley/images/people/maggie_siff_small.jpg" alt="">
                    
                  </div>
                  <div data-js-hook="hero-ctas">
                    <a href="app/get_started" class="u-linkAsButton ft-get-started-cta u-displayNone--until-md sc-m-r--xs"
                      data-behavior-get-started-click="">Get started</a>
								<a class="u-flexInline u-flexAlignItemsBaseline u-linkAsButton sc-SecondaryButton u-knockout u-displayNone--until-md" href="javascript:void(0)" data-behavior-video-play-click data-video-id="Ihv1uHlmdpw"><span class="sc-Icon sc-Icon--12 sc-m-r--xs">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"  aria-hidden="true" >

								  <polygon points="15 8 5 16 5 0"/>
								</svg>
								</span>
								Watch our video</a>
										  
   


                    <a href="app/get_started" class="u-linkAsButton u-displayNone--md ft-get-started-cta u-fullWidth sc-m-b--s sc-m-t--0"
                      data-behavior-get-started-click="">Get started</a>
					 <a class="u-knockout u-displayNone--md u-flexRow u-flex u-flexAlignItemsCenter sc-m-b--l u-flexJustifyCenter " href="javascript:void(0)" data-behavior-video-play-click data-video-id="Ihv1uHlmdpw"><span class="sc-Icon sc-Icon--12 sc-m-r--xs">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"  aria-hidden="true" >

					  <polygon points="15 8 5 16 5 0"/>
					</svg>
					</span>
					<strong>Watch our video</strong></a>
					  
					  
					  
                    
    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

		
		
        <div class="u-displayNone--md">
          <div class="sc-SectionLayout sc-backgroundColor-grey-10 sc-p-t--0">
            <div class="sc-SectionLayout-contentWrapper u-flex u-flexCol u-topNegativeVerticalOffset sc-backgroundColor-white sc-p--l sc-p-lg--48 u-shadow-small ft-feature-icons-prospect">
              <div class="u-flexBasisAuto ">
              </div>
              <div class="sc-ContentLayout ">
                <div class="sc-ContentSlot u-col-12 sc-p-b--m sc-col-lg-4 sc-p-b--0">
                  <div class="sc-ListItem sc-ListItem-l--iconTop sc-ListItem--withFeatureIcon u-lg-flexCol sc-m-b--s sc-m-b-md--l sc-m-b-lg--0">
                    <div class="sc-ListItem-label">
                      <span class="sc-Icon sc-Icon--feature sc-Icon--primary-blue sc-Icon--secondary-grey-60 sc-ListItem-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true">

                          <path class="sc-Icon--secondary-color" d="M0 15V9h6v6H0zm42 24v-6h6v6h-6zM0 39v-6h30v6H0zm18-24V9h30v6H18z"></path>
                          <path class="sc-Icon--primary-color" d="M6 21V3h10v18H6zm24 24V27h10v18H30z"></path>
                        </svg>
                      </span>

                      <h4>We'll learn a bit about you.</h4>
                    </div>
                    <div class="sc-ListItem-body">
                      <p>Where are you in your financial life and what are you investing for? Dream vacation? Down payment? Nice little retirement?</p>
                    </div>
                  </div>
                </div>
                <div class="sc-ContentSlot u-col-12 sc-p-b--m sc-col-lg-4 sc-p-b--0">
                  <div class="sc-ListItem sc-ListItem-l--iconTop sc-ListItem--withFeatureIcon u-lg-flexCol sc-m-b--s sc-m-b-md--l sc-m-b-lg--0">
                    <div class="sc-ListItem-label">
                      <span class="sc-Icon sc-Icon--feature sc-Icon--primary-blue sc-Icon--secondary-grey-60 sc-ListItem-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true">

                          <path class="sc-Icon--secondary-color" d="M24 40a16 16 0 0 1-2-32V0a24 24 0 1 0 17.5 42.2l-5.7-5.7A16 16 0 0 1 24 40"></path>
                          <path class="sc-Icon--primary-color" d="M39.9 22A16 16 0 0 0 26 8V0a24 24 0 0 1 21.9 22h-8zm0 4h8c-.4 5-2.4 9.7-5.6 13.4l-5.7-5.7A16 16 0 0 0 40 26z"></path>
                        </svg>
                      </span>

                      <h4>We'll build you a portfolio</h4>
                    </div>
                    <div class="sc-ListItem-body">
                      <p>Based on your answers, we'll recommend an investing plan and use our technology to build you a personalized portfolio.</p>
                    </div>
                  </div>
                </div>
                <div class="sc-ContentSlot u-col-12 sc-col-lg-4 sc-p-b--0">
                  <div class="sc-ListItem sc-ListItem-l--iconTop sc-ListItem--withFeatureIcon u-lg-flexCol sc-m-b--s sc-m-b-md--l sc-m-b-lg--0">
                    <div class="sc-ListItem-label">
                      <span class="sc-Icon sc-Icon--feature sc-Icon--primary-blue sc-Icon--secondary-grey-60 sc-ListItem-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true">

                          <path class="sc-Icon--secondary-color" d="M0 48V24h10v24H0zm19 0V12h10v36H19z"></path>
                          <polygon class="sc-Icon--primary-color" points="38 48 48 48 48 0 38 0"></polygon>
                        </svg>
                      </span>

                      <h4>Then, we put our magic to work.</h4>
                    </div>
                    <div class="sc-ListItem-body">
                      <p>And we keep working. Once we get you set up, we'll manage your portfolio with tax-smart technology.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="u-displayNone--md ft-small-screen-content">
        <div class="sc-SectionLayout sc-backgroundColor-grey-10" data-js-hook="">
          <div class="sc-SectionLayout-contentWrapper ">
            <div class="sc-ContentLayout u-flexJustifyCenter">
              <div class="sc-ContentSlot ">




              </div>
            </div>
          </div>
        </div>


      </div>
      <div class="u-displayNone--until-md ft-large-screen-content">

        <div class="" data-behavior-prospect-content="">
          <div class="sc-SectionLayout sc-backgroundColor-grey-10 sc-p-t--0" data-js-hook="">
            <div class="sc-SectionLayout-contentWrapper u-topNegativeVerticalOffset--large">
              <div class="sc-ContentLayout ">
                <div class="sc-ContentSlot ">
                  <div class="u-hideUntilVisitorStateKnown" data-split-name="brochure_b2b_links_in_homepage_hero_q4_2018"
                    data-split-variant="treatment">
                    <div class="u-displayFlex u-flexJustifyEnd u-bottomNegativeVerticalOffset--small">



                    </div>
                  </div>
                  <div data-react-app="PersonaChooser"></div>
                  <div data-react-portal="PersonaChooser.PersonaChooser">
                    <div class="PersonaChooser u-col-12" data-tabs="true">
                      <h4 class="u-color-white"> </h4>
                      <ul class="PersonaChooser-tabList" role="tablist">
                        <li data-track-event="ElementClicked" data-track-module="PersonaChooser" data-track-name="NewInvestor"
                          class="PersonaChooser-tab" role="tab" id="react-tabs-0" aria-selected="false" aria-disabled="false"
                          aria-controls="react-tabs-1">
                          <h4 class="u-col-8 u-col-offset-2 sc-m-b--xs">We'll learn a bit about you</h4>
                          <p class="u-col-8 u-col-offset-2">Where are you in your financial life and what are you investing for? Dream vacation? Down payment? Nice little retirement?</p>
                        </li>
                        <li data-track-event="ElementClicked" data-track-module="PersonaChooser" data-track-name="HandsOffInvestor"
                          class="PersonaChooser-tab" role="tab" id="react-tabs-2" aria-selected="false" aria-disabled="false"
                          aria-controls="react-tabs-3">
                          <h4 class="u-col-8 u-col-offset-2 sc-m-b--xs">We'll build you a portfolio</h4>
                          <p class="u-col-8 u-col-offset-2">Based on your answers, we'll recommend an investing plan and use our technology to build you a personalized portfolio.</p>
                        </li>
                        <li data-track-event="ElementClicked" data-track-module="PersonaChooser" data-track-name="HandsOnInvestor"
                          class="PersonaChooser-tab is-active" role="tab" id="react-tabs-4" aria-selected="true"
                          aria-disabled="false" aria-controls="react-tabs-5" tabindex="0">
                          <h4 class="u-col-8 u-col-offset-2 sc-m-b--xs">Then, we put our magic to work.</h4>
                          <p class="u-col-8 u-col-offset-2">And we keep working. Once we get you set up, we'll manage your portfolio with tax-smart technology.</p>
                        </li>
                      </ul>

                      <div class="PersonaChooser-tabPanelContainer">
                        <div class="PersonaChooser-tabPanel" role="tabpanel" id="react-tabs-1" aria-labelledby="react-tabs-0"></div>
                        <div class="PersonaChooser-tabPanel" role="tabpanel" id="react-tabs-3" aria-labelledby="react-tabs-2"></div>
                        <div class="PersonaChooser-tabPanel is-active" role="tabpanel" id="react-tabs-5"
                          aria-labelledby="react-tabs-4">
                          <div class="sc-ContentLayout u-flexJustifyBetween sc-p-v--m">
                            <div class="PersonaChooser-tabPanel-left sc-ContentGrid-item u-col-12 u-col-6@md">
                              <h2 class="sc-m-b--48">Included Featues for  Operation.</h2>
                              <div class="sc-p-b--l u-border-b sc-m-b--m u-col-10">
                                <div class="sc-ListItem sc-ListItem--withUiIcon-s">
                                  <div class="sc-ListItem-label"><span class="sc-Icon sc-Icon--s sc-Icon--blue sc-ListItem-icon"><svg
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true">
                                        <polygon points="14.592 1.72 5.476 10.681 1.436 6.517 0 7.909 5.443 13.519 15.994 3.146"></polygon>
                                      </svg></span>
                                    <h4>Real Time monitoring.</h4>
                                  </div>
                                  <div class="sc-ListItem-body">
                                    <p>Institutions can take advantage of real-time monitoring and integrated clearing
                                      at the OTC Desk.</p>
                                  </div>
                                </div>
                                <div class="sc-ListItem sc-ListItem--withUiIcon-s">
                                  <div class="sc-ListItem-label"><span class="sc-Icon sc-Icon--s sc-Icon--blue sc-ListItem-icon"><svg
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true">
                                        <polygon points="14.592 1.72 5.476 10.681 1.436 6.517 0 7.909 5.443 13.519 15.994 3.146"></polygon>
                                      </svg></span>
                                    <h4>DEEP LIQUIDITY.</h4>
                                  </div>
                                  <div class="sc-ListItem-body">
                                    <p>Access EXMCapital global network of clients across over 100 countries and in
                                      many digital assets (BTC, ETH, BCH, LTC, XLM, PAX, USDT and more to come soon)</p>
                                  </div>
                                </div>
                                <div class="sc-ListItem sc-ListItem--withUiIcon-s">
                                  <div class="sc-ListItem-label"><span class="sc-Icon sc-Icon--s sc-Icon--blue sc-ListItem-icon"><svg
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true">
                                        <polygon points="14.592 1.72 5.476 10.681 1.436 6.517 0 7.909 5.443 13.519 15.994 3.146"></polygon>
                                      </svg></span>
                                    <h4>Secure Exchange</h4>
                                  </div>
                                  <div class="sc-ListItem-body">
                                    <p>We have established multi-level security system to ensure that our members at
                                      the Exchange are protected.</p>
                                  </div>
                                </div>
                              </div>
                              <h4>Invest Wisely <a href="app/guidance" data-track-event="ElementClicked" data-track-module="PersonaChooser"
                                  data-track-name="HandsOnInvestorPersonaCta">See
                                  what is right for you &gt;</a></h4>
                            </div>
                            <div class="PersonaChooser-tabPanel-right sc-ContentGrid-item u-col-12 u-col-6@md">
                              <div class="PersonaChooser-tabPanel-right-image PersonaChooser-tabPanel-right-image--handsOnInvestor"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


<div class="sc-SectionLayout sc-p-b--0 sc-p-t--xl sc-p-t-md--xxl sc-m-b--xxl">
  <div class="sc-SectionLayout-contentWrapper sc-m-b-md--xl">
    <div class="sc-ContentLayout u-flexJustifyBetween u-flexAlignItemsCenter">

      <div class="sc-ContentGrid-item u-col-12 ">
              </div>

      <div class="sc-ContentGrid-item u-col-12 sc-p-b--m sc-p-b-md--0 u-col-6@md">
            <img
  class="sc-p-b--l"  src="wp-content/themes/foley/images/people/lady_laptop_couch.png"
  alt=""
  
>

    <div class="u-blueBlockQuote u-col-12 u-col-10@lg u-col-offset-2@lg">
      <h3>On average our investing principles can increase returns by 2.66% when compared to the typical investor.</h3>
    </div>
        </div>
      <div class="sc-ContentGrid-item u-col-12 u-col-5@md sc-p-t--s sc-p-t-md--l">
            <h2>Our mission is to help our customers maximize their&nbsp;money.</h2>
    <p>Whether you're new to investing or a seasoned pro, Betterment does what is right for you and your money. On average, our investing principles can increase returns by 2.66% when compared to the typical investor.</p>
    <a href="why-betterment"
       class="u-linkAsButton sc-SecondaryButton">Why Betterment?</a>
        </div>
    </div>
  </div>
</div>

<div class="sc-SectionLayout sc-p-t--0 sc-backgroundColor-grey-10 sc-p-b-md--xl">
  <div class="sc-SectionLayout-contentWrapper u-topNegativeVerticalOffset">
    <div class="sc-ContentLayout u-flexJustifyBetween">

      <div class="sc-ContentGrid-item u-col-12 ">
              </div>

      <div class="sc-ContentGrid-item u-col-12 sc-p-b--m sc-p-b-md--0 u-col-6@md u-flex">
            <div class="sc-backgroundColor-white u-shadow-small u-border sc-p--l">
      <div class="sc-ListItem sc-ListItem--withFeatureIcon u-lg-flexCol sc-m-b--m sc-m-b-lg--0">
        <div class="sc-ListItem-label">
          <span class="sc-Icon sc-Icon--feature sc-Icon--primary-blue sc-Icon--secondary-grey-60 sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  aria-hidden="true" >

  <polygon class="sc-Icon--secondary-color" points="39.811 2 19.212 31.417 5.736 21.982 0 30.173 21.668 45.345 48.002 7.736"/>
  <path class="sc-Icon--primary-color" d="M48 40.3a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
</svg>
</span>

          <h4>Satisfaction guaranteed.</h4>
        </div>
        <div class="sc-ListItem-body">
          <p>At Betterment, our passion is your investing experience. If you ever feel we've missed the mark, let us know. We'll do everything we can to make it&nbsp;right.</p>
        </div>
      </div>
    </div>
        </div>
      <div class="sc-ContentGrid-item u-col-12 u-col-6@md u-flex">
            <div class="sc-backgroundColor-white u-shadow-small u-border sc-p--l">
      <div class="sc-ListItem sc-ListItem--withFeatureIcon u-lg-flexCol sc-m-b--m sc-m-b-lg--0">
        <div class="sc-ListItem-label">
          <span class="sc-Icon sc-Icon--feature sc-Icon--primary-blue sc-Icon--secondary-grey-60 sc-ListItem-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"  aria-hidden="true" >

  <path class="sc-Icon--primary-color" d="M7.9 14.4a2.4 2.4 0 1 1-3.4-3.5 2.4 2.4 0 0 1 3.4 3.5zm5.3-7.6H.2l.1 12.8 22.2 22.2 12.8-12.9L13.2 6.8z"/>
  <polygon class="sc-Icon--secondary-color" points="25.655 7.095 18.37 7.095 40.214 28.944 31.015 38.146 35.001 42.13 47.841 29.286"/>
</svg>
</span>

          <h4>You pay one low, annual fee.</h4>
        </div>
        <div class="sc-ListItem-body">
          <p>Worried about hidden costs? Nowhere to be found. No matter who you are, you get everything for one low, transparent fee of 0.25&#37; (4X lower than what you'd typically pay for advice).</p>
        </div>
      </div>
    </div>
        </div>
    </div>
  </div>
</div>

<div class="sc-SectionLayout sc-backgroundColor-grey-10" data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper u-md-textCenter">
    <div class="sc-ContentLayout ">
      <div class="sc-ContentSlot ">
            <h2 class="">How does it work?</h2>
    <div class="u-darkSpacer u-darkSpacer--center sc-p-t--s"></div>
        </div>
    </div>
  </div>
</div>
<div class="sc-SectionLayout sc-backgroundColor-grey-10 sc-p-t--0 sc-p-t-md--l sc-p-b--xxl">
  <div class="sc-SectionLayout-contentWrapper u-flex u-flexCol ">
    <div class="u-flexBasisAuto ">
          </div>
    <div class="sc-ContentLayout u-flexAlignItemsStart">
      <div class="sc-ContentSlot u-col-12 sc-p-b--m u-grid u-col-4@md sc-p-b--0 sc-p-b-md--l">
            <div class="NumberIcon u-col-12 u-col-2-of-10@lg">
      <span class="NumberIcon-content NumberIcon-content--blue u-superTitle">01</span>
    </div>
    <div class="u-col-12 u-col-8-of-10@lg sc-p-l--0 sc-p-l-lg--xs sc-p-t--xs">
      <h3>We'll learn a bit about&nbsp;you.</h3>
      <p>Where are you in your financial life and what are you investing for? Dream vacation? Nice little retirement?</p>
    </div>
        </div>
      <div class="sc-ContentSlot u-col-12 sc-p-b--m u-grid u-col-4@md sc-p-b--0 sc-p-b-md--l">
            <div class="NumberIcon u-col-12 u-col-2-of-10@lg">
      <span class="NumberIcon-content NumberIcon-content--blue u-superTitle">02</span>
    </div>
    <div class="u-col-12 u-col-8-of-10@lg sc-p-l--0 sc-p-l-lg--xs sc-p-t--xs">
      <h3>We'll build you a portfolio.</h3>
      <p>Based on your answers we'll recommend an investing plan designed for your risk tolerance and time horizon.</p>
    </div>
        </div>
      <div class="sc-ContentSlot u-col-12 u-grid u-col-4@md sc-p-b--0 sc-p-b-md--l">
            <div class="NumberIcon u-col-12 u-col-2-of-10@lg">
      <span class="NumberIcon-content NumberIcon-content--blue u-superTitle">03</span>
    </div>
    <div class="u-col-12 u-col-8-of-10@lg sc-p-l--0 sc-p-l-lg--xs sc-p-t--xs">
      <h3>Then, we put our magic to&nbsp;work.</h3>
      <p>And we'll keep working. Once we get you set up we'll manage your portfolio with our tax-smart technology.</p>
    </div>
        </div>
    </div>
  </div>
</div>


<div class="sc-SectionLayout sc-p-v--0 sc-backgroundColor-grey-60" data-js-hook="">
  <div class="sc-SectionLayout-contentWrapper u-topNegativeVerticalOffset sc-backgroundColor-white">
    <div class="sc-ContentLayout sc-backgroundColor-white sc-p--l sc-p-md--0">
      <div class="sc-ContentSlot ">
            <div class="u-hideUntilVisitorStateKnown" data-split-name="main-ctas" data-split-variant="mad-lib">
  <div data-js-hook-start-onboarding-forms>
  <div class="DesktopMadLib sc-p-v-md--xl sc-p-v-lg--xxl">
    <p class="DesktopMadLib-headline sc-m-b--l">Start your investment plan</p>
    <div class="DesktopMadLib-sentence sc-m-b--m">
      <h2>I am</h2>
      <input type="tel" placeholder="" maxlength="3" name="age" id="age" class="DesktopMadLib-input DesktopMadLib-ageInput"/>
      <h2>years old and</h2>
      <span class="edit-retirement">
        <div class="retirement border">
          <input type="text" value="" class="DesktopMadLib-input DesktopMadLib-retirementDropdown select-retirement" readonly />
          <ul class="retirement-dropdown">
            <li class="retirement-dropdown-option retirement-dropdown-not-retired" data-id="notRetired">Not Retired</li>
            <li class="retirement-dropdown-option retirement-dropdown-retired" data-id="retired">Retired</li>
          </ul>
        </div>
      </span>
      <h2>.</h2>
    </div>
    <div class="DesktopMadLib-sentence">
      <h2>My annual income is </h2>
      <input type="tel" placeholder="" maxlength="10" name="income" id="income" class="DesktopMadLib-input DesktopMadLib-incomeInput"/>
      <h2>.</h2>
    </div>
    <p class="u-textCenter DesktopMadLib-incomeError"></p>
    <p class="u-textCenter DesktopMadLib-ageError"></p>
  
    <button class="DesktopMadLib-button" onclick="load()">
      Get started
    </button>

  <script>
      function load(){
         var age = document.getElementById('age').value;
         var income = document.getElementById('income').value;
         location ='app/goal_type?age='+age+'&income='+income+'&';
      }
      
    </script>

  </div>
</div>

</div>

        </div>
    </div>
  </div>
</div>

<div class="sc-SectionLayout sc-backgroundColor-grey-60 sc-p-v--xl">
  <div class="sc-SectionLayout-contentWrapper ">
    <div class="sc-ContentLayout ">

      <div class="sc-ContentGrid-item u-col-12 ">
              </div>

      <div class="sc-ContentGrid-item u-col-12 sc-p-b--m sc-p-b-md--0 u-grid u-col-6@lg sc-p-b--l">
            <div class="NumberIcon">
      <span class="NumberIcon-content NumberIcon-content--blue u-superTitle">&ldquo;</span>
    </div>
    <div class="u-col-10 u-col-11@md sc-p-t--xxs sc-p-l--s">
      <h3 class="u-color-white u-displayInline">Betterment has made a name for itself among US retail investors.</h3>
      <h4 class="u-color-white sc-p-t--s">- Financial Times</h4>
    </div>
        </div>
      <div class="sc-ContentGrid-item u-col-12 u-grid u-col-6@lg sc-p-t-md--48 sc-p-t-lg--0">
            <div class="NumberIcon">
      <span class="NumberIcon-content NumberIcon-content--blue u-superTitle">&ldquo;</span>
    </div>
    <div class="u-col-10 u-col-11@md sc-p-t--xxs sc-p-l--s">
      <h3 class="u-color-white u-displayInline">It's hard to overestimate the broader impact Betterment has had on financial advice in the&nbsp;U.S.</h3>
      <a href="http://webreprints.djreprints.com/4278330849276.pdf" class="u-unstyledLink sc-ListItem sc-ListItem--withUiIcon-m u-lg-flexCol sc-m-b--l sc-m-b-lg--0" target="_blank" rel="noopener noreferrer">
        <img
  class="u-displayBlock sc-m-t--s"  src="wp-content/themes/foley/images/logos/barrons.jpg"
  alt="Barron&#039;s"
  
>

      </a>
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
// adding scripts:

include('scripts.php');

?>


  </body>

</html>