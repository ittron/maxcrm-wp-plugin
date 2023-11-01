window.omnigoSettings = {
	locale: omnigo_widget_locale,
	type: omnigo_widget_type,
	position: omnigo_widget_position,
	launcherTitle: omnigo_launcher_text,
};

(function (d, t) {
	var g = d.createElement(t),
		s = d.getElementsByTagName(t)[0];
	g.async = !0;
	g.defer = !0;
	g.src = "https://omnigo.id/livechat/js";
	s.parentNode.insertBefore(g, s);
	g.onload = function () {
		window.omnigoSDK.run({
			websiteToken: omnigo_token,
			baseUrl: omnigo_url,
		});
	};
})(document, "script");
