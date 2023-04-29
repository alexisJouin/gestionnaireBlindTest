<html>
<head>
    <meta charset="UTF-8">
    <title>Blind Test</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
		function startChrono() {
			var startTime = Date.now();
			var timer = setInterval(function() {
				var elapsedTime = Date.now() - startTime;
				document.getElementById("chrono").innerHTML = elapsedTime / 1000;
			}, 100);
		}
	</script>
</head>
<body>
    <button onclick="showPoints()">Système d'options</button>
	<div id="system">
		<h2>Choisissez vos options :</h2>
		<form>
            <h3> Système de points</h3><br>
            <button onclick="startChrono()">Activer le chronomètre</button>
	        <p id="chrono">0</p>

            <h3> Contre la montre</h3><br>
            <input type="checkbox" name="activer" id="proposition3">
            <label for="activer"> activer</label><br>
            <input type="checkbox" name="desactiver" id="proposition4">
            <label for="desactiver"> desactiver</label><br>

            <h3> Mode multi joueur</h3><br>
            <input type="checkbox" name="activer" id="proposition5">
            <label for="activer"> activer</label><br>
            <input type="checkbox" name="desactiver" id="proposition6">
            <label for="desactiver">desactiver</label><br>  
            <input type="submit" value="Soumettre">
        </form>
</body>
</html>