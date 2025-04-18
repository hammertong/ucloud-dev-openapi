window.onload = function() {
  //<editor-fold desc="Changeable Configuration Block">

  // the following lines will be replaced by docker/configurator, when it runs in a docker-container
  window.ui = SwaggerUIBundle({
    url: "api.php",
    dom_id: '#swagger-ui',
    deepLinking: true,
    presets: [
      SwaggerUIBundle.presets.apis,
      SwaggerUIStandalonePreset
    ],
    plugins: [
      SwaggerUIBundle.plugins.DownloadUrl
    ],
    layout: "StandaloneLayout",

    onComplete: () => {
	console.log("swagger ui completed");
    },
    //requestInterceptor: (req) => {
    //    if (req.url.includes('/path_that_requires_session_cookie')) {
    //        req.headers['Cookie'] = 'session=your-session-cookie-value';
    //    }
    //    return req;
    //},

    //filter: true,

    validatorUrl: null,

    docExpansion: "none", // Riduce al minimo le operazioni di default
    //defaultModelsExpandDepth: -1 // Nasconde i modelli nella UI
    defaultModelsExpandDepth: 1, // Controlla la profondità di espansione degli oggetti
    defaultModelExpandDepth: 2, // Controlla la profondità delle proprietà degli oggetti
    displayRequestDuration: true, // Mostra la durata della richiesta

  });

  //</editor-fold>
};
