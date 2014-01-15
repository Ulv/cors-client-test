<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <script type="text/javascript">
        var talker = new serverTalker();

        function serverTalker(responseGet, responsePost) {
            this.url = 'http://cors-srv.96.lt/';
            this.xhr = new XMLHttpRequest();

            this.responseGet = responseGet || "response_GET";
            this.responsePost = responsePost || "response_POST";

            this.sendGet = function () {
                var self = this;

                this.params = "client_id=" + Math.round(Math.random() * 10000);

                if (self.xhr) {
                    self.xhr.open('GET', this.url + "?" + this.params, true);
                    self.xhr.onreadystatechange = function () {
                        if (self.xhr.readyState == 4 && self.xhr.status == 200) {
                            var li = document.createElement("li");
                            li.innerHTML = "<b>Response:</b> " + self.xhr.responseText;

                            document.getElementById(self.responseGet).appendChild(li);
                        }
                    };
                    self.xhr.send();
                }
            }

            this.sendPost = function () {
                var self = this;

                this.params = "client_id=" + Math.round(Math.random() * 10000);

                if (self.xhr) {
                    self.xhr.open('POST', this.url, true);
                    self.xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    self.xhr.setRequestHeader("Content-length", this.params.length);
                    self.xhr.setRequestHeader("Connection", "close");

                    self.xhr.onreadystatechange = function () {
                        if (self.xhr.readyState == 4 && self.xhr.status == 200) {
                            var li = document.createElement("li");
                            li.innerHTML = "<b>Response:</b> " + self.xhr.responseText;

                            document.getElementById(self.responsePost).appendChild(li);
                        }
                    };
                    self.xhr.send(this.params);
                }
            }
        }
    </script>
</head>
<body>
<h1>CORS test</h1>

GET
<ul id="response_GET"></ul>
<button onclick="talker.sendGet();">Send GET to server</button>

<br/>
POST
<ul id="response_POST"></ul>
<button onclick="talker.sendPost();">Send POST to server</button>

</body>
</html>
