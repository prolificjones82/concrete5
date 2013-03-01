var me = this;
im.bind('filterFullyLoaded',function(e){
	if (e.eventData.namespace === me.namespace){
		//This is me, start initialization.
		me.label.text(me.name);
	}
});
im.bind('filterChange',function(e){
	if (e.eventData.namespace === me.namespace) {
		if (!me.controls.hasClass('active')) return;
		// Just apply, there is no variation.
		im.showLoader('Applying Grayscale');
		me.controls.stop(1,1).hide();
		me.label.click();

		setTimeout(function(){
			im.activeElement.applyFilter(im.filter.grayscale,{},function(){
				$.fn.dialog.hideLoader();
				im.fire('filterApplied', me);
				im.fire('GrayscaleFilterDidFinish');
				console.log('derp');
				im.activeElement.parent.draw();
			});
			// Apply Filter
		}, 10);
	}
});