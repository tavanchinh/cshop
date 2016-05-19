!function(e) {
	e.fn.extend({
		decode: function(id) {
			return this.each(function() {
				var r = e(this).attr("src");
				if (r.indexOf('http') == -1) {
					t = GibberishAES.dec(r, '4590481877' + id);
					e(this).attr("src", t)
				}
			})
		}
	})
}(jQuery);