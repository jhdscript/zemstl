jQuery(function() {
	var zemstl = []; //to prepare when multirendering works
	jQuery(".zemstl").each(function(idx, itm) {
		try {
			thingiurlbase = "wp-content/plugins/zemstl/js/";
			var item = jQuery(itm);
			var itemhtml = item.html();
			var stlid = item.attr("id");
			var stlurl = item.attr("data-stl");
			var stlplanes = item.attr("data-planes");
			var stlrotation = item.attr("data-rotation");
			var stlcamera = item.attr("data-camera");
			var stlzoom = item.attr("data-zoom");
			var stlcolor = item.attr("data-color");
			var stlbgcolor = item.attr("data-bgcolor");
			var stlmaterial = item.attr("data-material");

			var thingiview = new Thingiview(stlid);
			if (stlplanes === "0") {
				thingiview.setShowPlane(false);
			}
			if (stlrotation === "0"){
				thingiview.setRotation(false);
			}

			thingiview.setObjectMaterial(stlmaterial);
			/* Camera and Zoom don't work good */
			//thingiview.setCameraView("diagonal");
			//thingiview.setCameraZoom(5);
			thingiview.setObjectColor(stlcolor);
			thingiview.setBackgroundColor(stlbgcolor);
			thingiview.initScene();

			if ((stlid !== undefined) && (stlurl !== undefined) && (stlurl.length > 0)) {
				try {
					thingiview.loadSTL(stlurl);
				} catch (err) {}
			} else if ((itemhtml !== undefined) && (itemhtml.length > 0)) {
				try {
					thingiview.loadSTLString(itemhtml);
				} catch (err) {}
			}
			zemstl[stlid] = thingiview;
		} catch (err) {}
	});
});