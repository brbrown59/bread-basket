/**
 * Created by Tamra on 12/14/2015.
 */
app.config(function(uiGmapGoogleMapApiProvider) {
	uiGmapGoogleMapApiProvider.configure({
		key: 'AIzaSyDs9bT_pG1HO8cRBeki59gnXWMM1Ap2uMI', //    key: 'your api key',
		v: '3.20', //defaults to latest 3.X anyhow
		libraries: 'weather,geometry,visualization'
	});
})