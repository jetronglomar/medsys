<script>


var conn = new WebSocket('ws://localhost:8000');
conn.onopen = function(e) {
    console.log("Connection established!");
    
};  

conn.onmessage = function(e) {
    console.log(e.data);
};

$('#disconnect').on('click', function(){
conn.send('test');
}

</script>