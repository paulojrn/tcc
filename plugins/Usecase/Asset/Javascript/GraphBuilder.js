$(document).ready(function() {
    var nodesInfo = JSON.parse($('#graph-nodes').html());
    var edgesInfo = JSON.parse($('#graph-edges').html());

    var nodes = new vis.DataSet(nodesInfo);
    var edges = new vis.DataSet(edgesInfo);

    var container = document.getElementById('mynetwork');
    var data = {
        nodes: nodes,
        edges: edges
    };

    var options = {
        nodes: {borderWidth: 2},
        interaction: {
            navigationButtons: true,
            keyboard: true,
            hover: true
        }
    };
    
    var network = new vis.Network(container, data, options);
    
    network.on("doubleClick", function(properties) {
		var str_url = this.body.nodes[properties.nodes[0]].options.url;
		str_url = str_url.replace(/&amp;/g, '&');
    	window.open(str_url, '_self');
    });
});

