//先new 一个websocket对象,地址是localhost+端口9501 ws是前面的协议声明,类似于
var ws = new WebSocket("ws://localhost:9501");//定义 打开事件 的回调,当连接ws成功后,会调用执行这个回调函数ws.onopen = function() {  console.log("client：打开连接");
ws.send("client：hello，服务端");
;//定义 服务器发送消息 的回调,当服务器主动发送消息到客户端时,会调用执行这个回调函数

ws.onmessage = function (e) {
    console.log("client：接收到服务端的消息 " + e.data);
    setTimeout(() => {
        ws.close();
    }, 5000);
};//定义 关闭连接 的回调,当连接关闭(服务端关闭,客户端关闭,网络断开等原因),会调用执行这个回调函数

ws.onclose = function (params) {
    console.log("client：关闭连接");
};
