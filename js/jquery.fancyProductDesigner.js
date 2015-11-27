//change fabricjs cursormap
fabric.Canvas.prototype.cursorMap = ['default', 'default', 'default', 'se-resize', 'default', 'default', 'default', 'default'];
var rotateIcon = new Image(),
	resizeIcon = new Image(),
	removeIcon = new Image(),
	copyIcon = new Image();

//set data url rotate icon
rotateIcon.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAACXBIWXMAAAsTAAALEwEAmpwYAAABWWlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS40LjAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyI+CiAgICAgICAgIDx0aWZmOk9yaWVudGF0aW9uPjE8L3RpZmY6T3JpZW50YXRpb24+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgpMwidZAAAC/0lEQVQ4EYWVu0tkUQyHc8cnVmI3inYitoKlpdjaWQ3iP7AIFrtoLwx2i42NaKWCjZVoY2PnaOcDUfE1F0FQ1MLnvdl8mTmXcZZlA2dy7knyS06Sk4nEaGtr60d3d/ev1tbWvFYo4vx/FEWR2ore3t7im5ub4sjIyG8He35+ruJowiZNU1/ZYZJ8+66Tu83Ly4sSWHR0dFTu7+/v/DIyxUYD8cDMsYR9U1OTJEniK5fLuRwZERpFDQ0NX41Gx8fHcc6u2WkaqRk0mrJiEIzgAJmi8+bmZneCM2RwA1NswQArhwv7yAVvuOeIRWRtbW2ysrIi6+vrDsBZxQRNIUQzjRzD9goghy7lhz2eW1paxHIrpVLJIywUCrKxsSGfn58uJ/JgFzDgcnZ25gl/f39X1sfHB1fQvb09HR4expP29vY6Z7+7u2t2qpZy18XGquwYYFUyXI3MmFhuxYxkcHBQDEgODg5kbGwMkczOzkpfX59Y8eTp6cl5yLcr8BMifH19dc/X19cezczMjIazyclJnZ6eVloDOj091fHxced8Bz2wMkDChpaWlhwQYAiQnZ0dfXh48GuRjqurK9cpFotZuuhNACm3E6GTcK44NTUl+Xzev6nq0NCQ61h+vV26urpkc3NTLAixXHqRqjCSAYYDQNvb213JAnROztjjFM7CCWAQ34GyonBAuwB2e3vr0dUCIAOYM4Dm5+dlcXHRbZBlVF+U7e1tz8/+/r45Vm+l0FIhzycnJ66zurrqOrVtU1sUnp9aO+jExERqHtWenBvQc8gsHV6ku7s7XVtb0/v7+xSFb1U+Pz/3Q4siDZ4uLy91dHTUo5ibm9M4jjFWqjowMKCHh4fuKERuxXIMsOTi4gJhgpBXAocAWF5ezq5PtES9sLCg5XLZX0qdTQIW4yu28ZW3a9WOL7XJ4m/88fFRmDIknjbp6OjwvYFRIJxExn18WW7jfw5Yckaz1hNnyGro+4Cl3Ezanp6enzZhOquKFlBlwNIq7FmhbYLM+F9/AX8AdQud0FqHQBoAAAAASUVORK5CYII=';
//set data url resize icon
resizeIcon.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAACXBIWXMAAAsTAAALEwEAmpwYAAABWWlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS40LjAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyI+CiAgICAgICAgIDx0aWZmOk9yaWVudGF0aW9uPjE8L3RpZmY6T3JpZW50YXRpb24+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgpMwidZAAAC6UlEQVQ4EYVUv0tjQRCefb5ECRoIpDEYDUkjSoqU6QUr/QvExs5Cy7s61Vme/4CFoDYBKyFtGiWQiCBKQLSQJKX4kxiTt/d9Q/Zx8TgysG93Z2a/+fnGCKhSqeyk0+mfU1NTs0EQWLAM+ePIGGOxTLfbbT8+Pu6trq7uK9jLy4sd0oA7QbkcubvjuftQrm9eX18tHTO3t7etxcXF1NfXV9/zPB9LoCgwrDv46qi78+LO2IlpJiYm+j4IWG1/cnIyBZ2AYBcXF7bRaJjp6Wnp9/vy9vYmKysrsry8LIPBIAR2oNzxzkJGvAApS/l0n3xYsfV63ezu7lJP6fj4WBYWFhTMee1kw50u0mPFoLseBMqkYGZmJtQvFouSz+clHo+HvP8d8NZhGAI6MgyTVCgU5Pz8XLa3t+Xy8pJhKZ9Gx5FquiSjUnJ0dCQHBwcKWq1WZXNzUzqdjkQiES3SOEC5u7uDYWvRS/bq6so+Pz/rvVar2VQqZWHAfnx8WFTbfn5+hqvX61m3yGctiGX4yWazAqGgUgKBOsEwW62WJJNJicVigkfaLuTD4khr8R6NRuX+/l7CHDJsgjlltsn8/LwqEoxANEg5z04f3RHmmJ6EgA6IilwkAtEI7wR5f3+Xw8NDQTo0p8wrexUpCd+EgARwQO5MEBJ3GiyXy7K1tSXr6+tyfX2tQOzVp6cn1WNUvp7GfOglQ1taWtJ1c3MjpVJJcrmcnJ2dqYEQgkXBA1YvcFXD/vdZK0sZCf+r3djYYENyBfDWttttlTWbTeshTI6g0MDwMMKgnF5yYcxJJpNx+oaVBWnHE8vHh485qwjuFEd2yLTCbPyTkxM5PT3VMB8eHvQHcBjIteejoTt4PcsRxKlBJCgwBNUjGIne0SCGqKytrbkCqlIikeA/6yMtbR+T9tfc3NxvDAYdQRB4BCPId+Kg+DYsNDro+fSeU1sfctKiiX9wNtI10D+A9A7873PRIkpDz0B7mJ37fwDDzTkRRcDc5gAAAABJRU5ErkJggg==';
//set data url remove icon
removeIcon.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAACXBIWXMAAAsTAAALEwEAmpwYAAABWWlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS40LjAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyI+CiAgICAgICAgIDx0aWZmOk9yaWVudGF0aW9uPjE8L3RpZmY6T3JpZW50YXRpb24+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgpMwidZAAACw0lEQVQ4EYWVPU9qQRCG9xwOQrCWRBNIoKOhobSh0t9BbwBNyCUE+mt7fwQtUNoQNRb+AiVRG8jlq+RDEPHsfd8Je3L4SO4kG93d2WfenTM7WAp2d3eXj8Vi5XA4fOq6rsaSxfX/mWVZGsNaLpf9Xq93e3l5+Udgk8lE0wD7gWkOgjdr8j/nZpj1jd8P59PpVFOY9fLy8jeVSp19f3+vocgJBoMKjgpzZdu2gu+WUAhSAMve0dERg1uYr3HOeX197du45hkOuYQx4sPDgxoMBgrrAiPUPxgAIAny+PhIXx0IBBwyyFIfHx+8J+bavb+/pxx9dXWlx+Mx1/RisdCr1UoGcqXX67WkpNVqiW+5XNbz+Vzy8/b25qr393dxANRFYgVGaLFY1KPRSKAEGRiBzWZTYPRrt9sSjI5kCZDJphIalRFG5+vraw+KnIo6P+zp6UnO8AZkbAGNCnpQmYHm83nv+o1Gw1Pmhxkxe0BGMpuEEkal1WpV1+v1g7Cvry/NcVAhgdykWhqvX6vVPFA6ndbPz8+yR1/6mb8GaEPBlrHOaEi+Ojk5UahRbz+TyahEIuHts5z2jPcm3R+NX5LD5IzKcrmcKC0UCno4HIpKU1I8axR6X9lc1cBMnUGBXJM5JYxz/9cn7CCQ0VjgBB4qDUqiMsII3a3TPYVIrkuVG2V8itpfGp+fn3JNf0nd3Ny4fHoUQTFSNoee3i7M5NdfUoCJ0kqlsvX0HPYzGN+znUwmFd6muri4UOfn59JxcBVpDgii0AQUbqGi0agqlUrSQLLZrEKnYWm42LfZvvoojVPIXqMMHKhgN2F0C0EOtjDCHcchXBMGkJztdDp9Gw3hN5ojHajWPT4+log8wBbG/sh2tTvgqyKRiIV9l0Jms5nqdru3UsXstPF4/FcoFDpjcpkD2F5zpTK/8StBnQWlfcL4E/AP1Ru/hjA7dpIAAAAASUVORK5CYII=';
//set data url copy icon
copyIcon.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2ZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDowMTgwMTE3NDA3MjA2ODExOEE2RDlFMzNBNzM3REJDNyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDowNUE4NkE1QkY4OUYxMUU0QjE0NEVCN0VBQjE0QUYyMCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDowNUE4NkE1QUY4OUYxMUU0QjE0NEVCN0VBQjE0QUYyMCIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IE1hY2ludG9zaCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjAxODAxMTc0MDcyMDY4MTE4QTZEQUI2OTEzMjkzN0EwIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjAxODAxMTc0MDcyMDY4MTE4QTZEOUUzM0E3MzdEQkM3Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+x3L2tAAABFxJREFUeNrsmUtIW1kYx788fD9QY0DtYihFJLsp4qtQEEEsKtQqo4giqODCuhmEURA3LmVKu3FjFypofaCoNGiFAVEYwY0LQZ2OdGEVJTUj0aDGqHG+/yFXot68vEl00Q8OJveenPs73/tcVWtrayQnV1dXGJH8UUPBlzOVSnXB484NrQxYFP95HRYWlsfjKf8oApeDCKdyOBwWu93+78XFxV/8vAVX0BuAPLE0JiamW6/XGyIiIkij0ZDcrgItsBbDkdVq/cNsNs/y52Z+7u4NQIZ7lZSU9CklJSVOrVZTKAVKCA8PJ51OFx4bG/t6e3tbb7PZ3jDHD7VkVtbcu9TU1JDD3RZYLi0t7QVb7y2+S4BFycnJhlCY0xeJjo6m+Pj4FraqTg37czC8jIqKehx0TmGLJrHCnmsByOrUKVnMZDIROzddXl7eCSqsj2vsPsRW8nlNrVZL7G5PpCBRlEZaW1tpdnZWQADodgBwdArfGhoaoqysLH+WDtMGwhzQXkdHBzU0NMgCzs/PU01NDVVVVdHo6Kg/kFcBAUSKYB+mhIQEt+YqKiqiwsJCKi8vp7GxMcrLy/PN1B7rz9kZra+v0/HxsdsEGxkZSe3t7SKpuxP4Juc1am5uRr6liooKmpqaouzsbGWAW1tbVFpaKnwLWrhtPsje3h6VlJRQT0+PTxppaWkR/lhbW0uDg4NeIT0CYtfISdgtVxmxe1ffgjQ2NlJfXx8dHh5Sf3+/MLecpnd3d2lhYUFsNCcnh3Jzc6m4uJjm5uYoMzPzfoCAwG45aQpQd3O6u7tpcXGRqqurRaTC7K7ClUGs09nZKb6jWmEOrnV1ddH09PT9AKXdw4fcyfn5OSUmJtLAwIDwLUTryMgIkv/1HEQtIlmygLM4iM0MDw97fH5ACi8eyJmfjEaj2ExdXZ0IsOuHsMZwPy4uTgxYBFEPq3ir/YoB0SatrKzQ0tISLS8vU1NTk9BWfX09nZycePytJ8v4bGJvAgcfHx8XPgh/hOnS09NpcnKSKisrqaysTNH6igGRA1HqpICBuWE2pCeLxaLYfRQDQmOuASEJEncgesugdadySf1RAQZKfgL+BAz2CS7oacZTo4GxurpKm5ubd84qgEN341oSQw6IPDgzMyNqNNosuTkFBQUPA4jOBbW2ra1NVBp3Z25vydwrIBZAB+J3iXJ24FJ9Dkqpw+LohHt7e/2G3NjYCMiLJwlQdiW0+fn5+TQxMeFXXYV5DQYDZWRkKK6YWmcHcip3F6064B5CsEnmOlIDkNv2r2g8H5Nw+mFGx7raSfuFT2X/PRY4aO/o6GielfdV7QyGfw4ODj66O6CHWsxms+P09PQDc11KgKD+c2dn5zOTB6yXu8/5xmQynezv77dxUBoFm+tbfudb/d84pfzOp65f+RCuCsVLTSR0u91+ZrVajTab7T3D/X2d6uT+DcHaxCn9F574DF09BfctP16iWnh8Y2V853HjWf8LMAB0YMuB3kGOawAAAABJRU5ErkJggg==';

//----------------------------------
// ------- Fabric.js Methods ----------
//----------------------------------


fabric.Object.prototype._drawControl = function(control, ctx, methodName, left, top) {
	var size = this.cornerSize;
	if (this.isControlVisible(control)) {

		var icon = false;
		if (control == 'tr' || control == 'br' || control == 'mtr' || control == 'tl') {
			switch (control) {
				case 'tr':
					icon = this.params.removable ? removeIcon : false;
					break;
				case 'br':
					icon = this.params.resizable ? resizeIcon : false;
					break;
				case 'mtr':
					icon = this.params.rotatable ? rotateIcon : false;
					break;
				case 'tl':
					icon = this.params.isInitial !== true && !this.params.hasUploadZone ? copyIcon : false;
					break;
			}

		}

		this.transparentCorners || ctx.clearRect(left, top, size, size);
		if (icon !== false) {
			ctx.drawImage(icon, left, top, size, size);
			ctx[methodName](left, top, size, size);
		}
	}
};
fabric.Object.prototype.findTargetCorner = function(pointer) {
	if (!this.hasControls || !this.active) return false;
	var ex = pointer.x,
		ey = pointer.y,
		xPoints, lines;
	for (var i in this.oCoords) {
		if (!this.isControlVisible(i)) {
			continue;
		}
		if (i === 'mtr' && !this.hasRotatingPoint) {
			continue;
		}
		if (this.get('lockUniScaling') && (i === 'mt' || i === 'mr' || i === 'mb' || i === 'ml')) {
			continue;
		}
		lines = this._getImageLines(this.oCoords[i].corner);
		xPoints = this._findCrossPoints({
			x: ex,
			y: ey
		}, lines);
		if (xPoints !== 0 && xPoints % 2 === 1) {
			this.__corner = i;
			return i;
		}
	}
	return false;
};
fabric.IText.prototype.initHiddenTextarea = function() {
	this.hiddenTextarea = fabric.document.createElement('textarea');

    this.hiddenTextarea.setAttribute('autocapitalize', 'off');
    this.hiddenTextarea.style.cssText = 'position: absolute; top: '+this.canvas.height * 0.5+'px; left: -1000px; opacity: 0;'
                                        + ' width: 0px; height: 0px; z-index: -999;';
    this.canvas.wrapperEl.appendChild(this.hiddenTextarea);

    fabric.util.addListener(this.hiddenTextarea, 'keydown', this.onKeyDown.bind(this));
    fabric.util.addListener(this.hiddenTextarea, 'input', this.onInput.bind(this));
    fabric.util.addListener(this.hiddenTextarea, 'copy', this.copy.bind(this));
    fabric.util.addListener(this.hiddenTextarea, 'paste', this.paste.bind(this));

    if (!this._clickHandlerInitialized && this.canvas) {
      fabric.util.addListener(this.canvas.upperCanvasEl, 'click', this.onClick.bind(this));
      this._clickHandlerInitialized = true;
    }
};

/**
 * var fpd = $('#fpd').fancyProductDesigner({width: 1200, stageHeight: 800}).data('fpd');
 * <br />
 * fpd.getProduct();
 * <br /><br />
 * $('#fpd').on('priceChange', function(evt, elementPrice, totalPrice) { <br />
 *     console.log(elementPrice); <br />
 * });
 *
 * @class FancyProductDesigner
 * @constructor
 * @param {HTMLElement} elem - HTML element to initialize instance on.
 * @param {Object} [opts] - The default options.
 */
var FancyProductDesigner = function(elem, opts) {

	/** @lends FancyProductDesigner.prototype */

	// @@include('../../envato/evilDomain.js')

	$ = jQuery;

	//merge the default options with the own set options
	var options = $.extend({}, $.fn.fancyProductDesigner.defaults, opts);
	options.elementParameters = $.extend({}, $.fn.fancyProductDesigner.defaults.elementParameters, options.elementParameters);
	options.textParameters = $.extend({}, $.fn.fancyProductDesigner.defaults.textParameters, options.textParameters);
	options.imageParameters = $.extend({}, $.fn.fancyProductDesigner.defaults.imageParameters, options.imageParameters);
	options.customTextParameters = $.extend({}, $.fn.fancyProductDesigner.defaults.customTextParameters, options.customTextParameters);
	options.customImageParameters = $.extend({}, $.fn.fancyProductDesigner.defaults.customImageParameters, options.customImageParameters);
	options.customAdds = $.extend({}, $.fn.fancyProductDesigner.defaults.customAdds, options.customAdds);
	options.dimensions = $.extend({}, $.fn.fancyProductDesigner.defaults.dimensions, options.dimensions);
	options.labels = $.extend({}, $.fn.fancyProductDesigner.defaults.labels, options.labels);
	options.socialPhotoAjaxSettings = $.extend({}, $.fn.fancyProductDesigner.defaults.socialPhotoAjaxSettings, options.socialPhotoAjaxSettings);

	/*function _testZ() {

		var objects = stage.getObjects();
		for (var i=0; i< objects.length; ++i) {
			var obj = objects[i];
				title = obj.title === undefined ? obj.name : obj.title;
			console.log(i, title +' on view:' + obj.viewIndex);
		}

	};*/

	//public variables
	var version = '3.0.8',
		thisClass = this,
		$window = $(window),
		$body = $('body'),
		$products,
		$designs,
		$elem,
		$initText,
		$mainContainer,
		$productStage,
		$contextDialog,
		$contextLoader,
		$colorPicker,
		$elementTooltip,
		$viewSelection,
		$editorBox,
		$fullLoader,
		stage,
		$productCategories = null,
		productCategories = [],
		$designCategories = null,
		designCategories = {},
		currentBoundingObject = null,
		currentUploadZone = null,
		viewsLength = 0,
		currentProductIndex = -1,
		currentViewIndex = 0,
		currentViews = null,
		currentElement = null,
		currentPrice = 0,
		responsiveScale = 1,
		viewOptions = {},
		mouseDownStage = false,
		dragStage = false,
		grabStartPointer,
		viewportPosition = new fabric.Point(0, 0),
		nonInitials = [],
		undos = [],
		redos = [],
		productCreated = false,
		startIndexUndo,
		endIndexUndo,
		$currentLazyLoadContainer = null,
		stageCleared = false,
		localStorageAvailable = true,
		instaAccessToken = null,
		tempLayerListItemTop,
		$internalModal = null;


	$elem = $(elem).width(options.width).addClass('fpd-container fpd-clearfix').before('<p class="fpd-initiliazing" style="width:'+options.width+'px;">'+options.labels.initText+'<br /><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiIgd2lkdGg9IjMyIiBoZWlnaHQ9IjMyIiBmaWxsPSJibGFjayI+CiAgPGNpcmNsZSB0cmFuc2Zvcm09InRyYW5zbGF0ZSg4IDApIiBjeD0iMCIgY3k9IjE2IiByPSIwIj4KICAgIDxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9InIiIHZhbHVlcz0iMDsgNDsgMDsgMCIgZHVyPSIxLjJzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSIgYmVnaW49IjAiCiAgICAgIGtleXRpbWVzPSIwOzAuMjswLjc7MSIga2V5U3BsaW5lcz0iMC4yIDAuMiAwLjQgMC44OzAuMiAwLjYgMC40IDAuODswLjIgMC42IDAuNCAwLjgiIGNhbGNNb2RlPSJzcGxpbmUiIC8+CiAgPC9jaXJjbGU+CiAgPGNpcmNsZSB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxNiAwKSIgY3g9IjAiIGN5PSIxNiIgcj0iMCI+CiAgICA8YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJyIiB2YWx1ZXM9IjA7IDQ7IDA7IDAiIGR1cj0iMS4ycyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIGJlZ2luPSIwLjMiCiAgICAgIGtleXRpbWVzPSIwOzAuMjswLjc7MSIga2V5U3BsaW5lcz0iMC4yIDAuMiAwLjQgMC44OzAuMiAwLjYgMC40IDAuODswLjIgMC42IDAuNCAwLjgiIGNhbGNNb2RlPSJzcGxpbmUiIC8+CiAgPC9jaXJjbGU+CiAgPGNpcmNsZSB0cmFuc2Zvcm09InRyYW5zbGF0ZSgyNCAwKSIgY3g9IjAiIGN5PSIxNiIgcj0iMCI+CiAgICA8YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJyIiB2YWx1ZXM9IjA7IDQ7IDA7IDAiIGR1cj0iMS4ycyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIGJlZ2luPSIwLjYiCiAgICAgIGtleXRpbWVzPSIwOzAuMjswLjc7MSIga2V5U3BsaW5lcz0iMC4yIDAuMiAwLjQgMC44OzAuMiAwLjYgMC40IDAuODswLjIgMC42IDAuNCAwLjgiIGNhbGNNb2RlPSJzcGxpbmUiIC8+CiAgPC9jaXJjbGU+Cjwvc3ZnPg==" /></p>');

	$initText = $elem.prev('.fpd-initiliazing');
	$products = $elem.children('.fpd-category').size() > 0 ? $elem.children('.fpd-category').remove() : $elem.children('.fpd-product').remove();
	$designs = $elem.children('.fpd-design');

	//test if browser is supported (safari, chrome, opera, firefox IE>9)
	var canvasTest = document.createElement('canvas'),
		canvasIsSupported = Boolean(canvasTest.getContext && canvasTest.getContext('2d'));

	if(!canvasIsSupported || (_isIE() && Number(_isIE()) <= 9)) {

		$.post(options.templatesDirectory+'canvaserror.php', function(html) {
			$elem.append($.parseHTML(html)).fadeIn(300);

			/**
		     * Gets fired as soon as a template has been loaded.
		     *
		     * @event FancyProductDesigner#templateLoad
		     * @param {Event} event
		     * @param {string} URL - The URL of the loaded template.
		     */
			$elem.trigger('templateLoad', [this.url]);
		});

		$initText.remove();

		/**
	     * Gets fired when the browser does not support HTML5 canvas.
	     *
	     * @event FancyProductDesigner#canvasFail
	     * @param {Event} event
	     */
		$elem.trigger('canvasFail');

		return false;
	}

	//execute this because of a ff issue with localstorage
	try {
		window.localStorage.length;
		window.localStorage.setItem('fpd-version', version);
		//window.localStorage.clear();
	}
	catch(error) {
		localStorageAvailable = false;
		//In Safari, the most common cause of this is using "Private Browsing Mode". You are not able to save products in your browser.
	}

	//lowercase all keys in hexNames
	var key,
		keys = Object.keys(options.hexNames),
		n = keys.length,
		newHexNames = {};

	while (n--) {
	  key = keys[n];
	  newHexNames[key.toLowerCase()] = options.hexNames[key];
	}
	options.hexNames = newHexNames;


	//----------------------------------
	// ------- LOAD TEMPLATES ----------
	//----------------------------------


	//load sidebar html
	$.post(options.templatesDirectory+'productdesigner.php',
		options.labels,
		function(html){

			$elem.append($.parseHTML(html));

			$fullLoader = $elem.children('.fpd-full-loader').hide();
			$mainContainer = $elem.children('.fpd-main-container');
			$productStage = $mainContainer.children('.fpd-product-stage').height(options.stageHeight);

			$elementTooltip = $productStage.children('.fpd-element-tooltip').html(options.labels.outOfContainmentAlert);
			$mainContainer.children('.fpd-context-dialog').remove().clone().appendTo($body);
			$contextDialog = $body.children('.fpd-context-dialog').addClass('fpd-hidden');
			$contextLoader =  $contextDialog.find('.fpd-context-loader');
			$colorPicker = $contextDialog.find('.fpd-color-picker');


			$elem.trigger('templateLoad', [this.url]);

			setTimeout(_initBars, 1000);

		}
	);


	//----------------------------------
	// ------- PRIVATE METHODS ---------
	//----------------------------------

	var _initBars = function() {

		//main buttons handler
		$elem.find('[data-context]').on('mouseup touchend', function() {

			var $this = $(this);
			currentUploadZone = null;
			thisClass.callDialogContent($this.data('context'), $this.children('span').text());

		});

		//download image handler
		if(options.imageDownloadable) {

			$elem.find('.fpd-download-image').on('mouseup touchend', function(evt) {
				var a = document.createElement('a');
				if (typeof a.download !== 'undefined') {
				    $elem.find('.fpd-download-anchor').attr('href', thisClass.getProductDataURL()).attr('download', 'Product.png')[0].click();
				}
				else {
					thisClass.createImage(true, true);
				}

			}).css('display', 'block');

		}

		//check if jsPDF is included
		if(options.saveAsPdf && window.jsPDF) {

			$elem.find('.fpd-save-pdf').on('mouseup touchend', function(evt) {
				evt.preventDefault();
				thisClass.deselectElement();

				var orientation = stage.getWidth() > stage.getHeight() ? 'l' : 'p';
				var doc = new jsPDF(orientation, 'mm', [options.width * 0.26, options.stageHeight * 0.26]),
					viewsDataURL = thisClass.getViewsDataURL('jpeg', 'white');

				for(var i=0; i < viewsDataURL.length; ++i) {
					doc.addImage(viewsDataURL[i], 'JPEG', 0, 0);
					if(i < viewsDataURL.length-1) {
						doc.addPage();
					}
				}

				doc.save('Product.pdf');

			}).css('display', 'block');

		}

		//print product handler
		if(options.printable) {

			$elem.find('.fpd-print').on('mouseup touchend', function(evt) {
				evt.preventDefault();
				thisClass.print();
			}).css('display', 'block');

		}

		//allow user to save products in a list
		if(localStorageAvailable && options.allowProductSaving && $elem.attr('id')) {

			$elem.find('.fpd-save-product, .fpd-load-saved-products').css('display', 'block');

			$elem.find('.fpd-save-product').on('mouseup touchend', function(evt) {
				evt.preventDefault();
				thisClass.deselectElement();

				//get key and value
				var product = thisClass.getProduct(false);
					thumbnail = thisClass.getViewsDataURL('png', 'transparent', 0.2)[0];

				//check if there is an existing products array
				var savedProducts = _getSavedProducts();
				if(savedProducts == null) {
					//create new
					savedProducts = new Array();
				}

				savedProducts.push({thumbnail: thumbnail, product: product});
				window.localStorage.setItem($elem.attr('id'), JSON.stringify(savedProducts));

				_addSavedProduct(thumbnail, product);
				thisClass.showMessage(options.labels.productSaved);

			});

			$elem.find('.fpd-load-saved-products').on('mouseup touchend', function(evt) {

				evt.preventDefault();
				thisClass.callDialogContent('saved-products', $(this).text());

			});

			//load all saved products into list
			var savedProducts = _getSavedProducts();
			if(savedProducts != null) {
				for(var i=0; i < savedProducts.length; ++i) {
					var savedProduct = savedProducts[i];
					_addSavedProduct(savedProduct.thumbnail, savedProduct.product);
				}
			}

		}

		//open/close more dropdown
		$elem.find('.fpd-more').on('click', function() {
			$(this).children('.fpd-dropdown-menu').addClass('fpd-do-trans');
		})
		.mouseleave(function() {
			$(this).children('.fpd-dropdown-menu').removeClass('fpd-do-trans');
		});
		$(document).on('touchend', function() {
			$elem.find('.fpd-more').mouseleave();
		});

		//undo/redo
		$elem.find('.fpd-undo, .fpd-redo').click(function() {

			if($(this).hasClass('fpd-undo')) {

				//store old params
				var oldParams = jQuery.extend({}, currentElement.params);
				redos.push({element: currentElement, parameters: oldParams});

				var last = undos.pop();
				if(last !== undefined && last.element !== undefined) {
					thisClass.setElementParameters(last.element, last.parameters);
				}
				undos.pop(); //pop again

			}
			else {

				var last = redos.pop();
				if(last !== undefined && last.element !== undefined) {
					thisClass.setElementParameters(last.element, last.parameters);
				}

			}

			$elem.find('.fpd-redo').toggleClass('fpd-disabled', redos.length == 0);

		});


		//reset product handler
		$elem.find('.fpd-reset-product').click(function(evt) {
			evt.preventDefault();
			thisClass.loadProduct(currentViews);
		}).show();

		//zoom tools
		$elem.find('.fpd-zoom').hide();
		if(options.maxZoom > 1) {

			$elem.find('.fpd-set-zoom').data('step', options.zoomStep).data('max', options.maxZoom)
			.on('slide', function(evt, ui) {
				thisClass.setZoom(ui.value);
			})

			$elem.find('.fpd-stage-pan').click(function() {
				dragStage = dragStage ? false : true;
				//toggles
				$(this).toggleClass('fpd-checked');
				$productStage.find('canvas').toggleClass('fpd-drag');
			});

			$elem.find('.fpd-zoom > .fpd-btn').click(function() {
				$elem.find('.fpd-set-zoom').slider('value', 1);
				dragStage = false;
				$productStage.find('canvas').removeClass('fpd-drag');
				$elem.find('.fpd-stage-pan').removeClass('fpd-checked');
				$(this).next('.fpd-option-content').stop().toggle(300);
				thisClass.resetZoom();
			}).parent().show();
		}

		_initProductStage();

	};

	var _initProductStage = function() {

		//create fabric stage
		var canvas = $productStage.children('canvas').get(0);
		stage = new fabric.Canvas(canvas, {
			selection: false,
			hoverCursor: 'pointer',
			controlsAboveOverlay: true,
			centeredScaling: true
		});
		stage.setDimensions({width: $elem.width(), height: options.stageHeight});

		//retina-ready
		if( window.devicePixelRatio !== 1 ){

		    var htmlCanvas = stage.getElement();

		    // Scale the canvas up by two for retina
		    htmlCanvas.setAttribute('width', $elem.width() * window.devicePixelRatio);
		    htmlCanvas.setAttribute('height', options.stageHeight * window.devicePixelRatio);

		    // finally set the scale of the context
		    htmlCanvas.getContext('2d').scale(window.devicePixelRatio, window.devicePixelRatio);

		}

		//attach handlers to stage
		stage.on({
			'mouse:down': function(opts) {

				grabStartPointer = stage.getPointer(opts.e);
				mouseDownStage = true;

				if(opts.target == undefined) {
					thisClass.closeDialog();
					thisClass.deselectElement();
				}
				else {
					var pointer = stage.getPointer(opts.e),
						targetCorner = opts.target.findTargetCorner(pointer);

					//remove element
					if(targetCorner == 'tr' && currentElement.params.removable) {
						thisClass.removeElement(currentElement);
					}

					//copy element
					if(targetCorner == 'tl' && currentElement.params.isInitial !== true && !currentElement.params.hasUploadZone) {
						var newParams = jQuery.extend({}, currentElement.params, {autoSelect: true, x: currentElement.params.x + currentElement.width});
						thisClass.addElement(currentElement.type, currentElement.source, 'Copy '+currentElement.title, newParams);
					}

				}
			},
			'mouse:up': function() {

				mouseDownStage = false;

			},
			'mouse:move': function(opts) {

				if(mouseDownStage && dragStage) {

					var currentPointer = stage.getPointer(opts.e),
						x = (viewportPosition.x + currentPointer.x - grabStartPointer.x),
						y = (viewportPosition.y + currentPointer.y - grabStartPointer.y);

					stage.relativePan(new fabric.Point(x, y));

				}

			},
			'text:changed': function(opts) {

				thisClass.setElementParameters(currentElement, {text: opts.target.text});

			},
			'object:moving': function(opts) {
				if((currentElement && currentElement.params.draggable) || options.editorMode) {

					thisClass.setElementParameters(currentElement,
						{
							x: Math.round(opts.target.left / responsiveScale),
							y: Math.round(opts.target.top / responsiveScale)
						}
					);


				}
			},
			'object:scaling': function(opts) {
				if((currentElement && currentElement.params.resizable) || options.editorMode) {

					thisClass.setElementParameters(currentElement,
						{
							scale: Number(opts.target.scaleX / responsiveScale).toFixed(2)
						}
					);

				}
			},
			'object:rotating': function(opts) {
				if((currentElement && currentElement.params.rotatable) || options.editorMode) {

					//reset origin because of a bug when origin-x is left
					currentElement.set({originX: currentElement.params.originX, originY: currentElement.params.originY});

					thisClass.setElementParameters(currentElement,
						{
							degree: Math.round(opts.target.angle)
						}
					);

				}
			},
			'object:selected': function(opts) {

				thisClass.deselectElement(false);

				//dont select anything when in dragging mode
				if(dragStage) {
					thisClass.deselectElement();
					return false;
				}

				currentElement = opts.target;
				var elemParams = currentElement.params;

				_setContextDialogPosition();

				//open adds if object is upload zone
				if(elemParams.uploadZone && !options.editorMode) {
					currentElement.set('borderColor', 'transparent');
					var customAdds = $.extend({}, viewOptions.customAdds, elemParams.customAdds ? elemParams.customAdds : {});
					var opts = {};
					opts.customAdds = customAdds;
					_updateInterface(opts);
					currentUploadZone = currentElement.title;
					thisClass.callDialogContent('adds', $elem.find('[data-context="adds"] span').text(), null, true);
					return false;
				}

				currentUploadZone = null;

				currentElement.set({
					borderColor: options.selectedColor,
					cornerColor: 'transparent',
					cornerSize: 20,
					rotatingPointOffset: 0,
					padding: currentElement.type == 'text' || currentElement.type == 'i-text' ? options.paddingControl : 0
				});

				thisClass.callDialogContent('edit', options.labels.editElement, null, false);

				//toggle colorpicker

				if(((Array.isArray(elemParams.colors) && _elementIsColorizable(currentElement) != false)) || currentElement.type == 'path-group') {

					//svg
					if(currentElement.type == 'path-group') {

						for(var i=0; i<currentElement.paths.length; ++i) {
							var path = currentElement.paths[i],
								color = tinycolor(path.fill);

							$colorPicker.append('<input type="text" value="'+color.toHexString()+'" />');
						}

						$colorPicker.addClass('fpd-colorpicker-group').find('input').spectrum({
							preferredFormat: "hex",
							showInput: true,
							change: function(color) {
								var pathIndex = $colorPicker.find('input').index(this);
								var svgColors = [];
								for(var i=0; i<currentElement.paths.length; ++i) {
									var path = currentElement.paths[i],
										c = tinycolor(path.fill);
									svgColors.push(c.toHexString());
								}
								svgColors[pathIndex] = color.toHexString();
								thisClass.setElementParameters(currentElement, {currentColor: svgColors});
							}
						});

						_updateSpectrum();

					}
					else {

						//color palette
						if(elemParams.colors.length > 1) {

							$colorPicker.html('<div class="fpd-color-palette fpd-grid"></div>');

							for(var i=0; i<elemParams.colors.length; ++i) {

								var color = elemParams.colors[i];
									colorName = options.hexNames[color.replace('#', '')];

								colorName = colorName ? colorName : color;
								$colorPicker.children('.fpd-grid').append('<div class="fpd-item fpd-tooltip" title="'+colorName+'" style="background-color: '+color+';"></div>')
								.children('.fpd-item:last').click(function() {
									var color = tinycolor($(this).css('backgroundColor'));
									thisClass.setElementParameters(currentElement, {currentColor: color.toHexString()});
								});

							}

							_updateTooltip();

						}
						//colorwheel
						else {

							$colorPicker.append('<input type="text" value="'+(elemParams.currentColor ? elemParams.currentColor : elemParams.colors[0])+'" />');

							$colorPicker.find('input').spectrum("destroy").spectrum({
								preferredFormat: "hex",
								showInput: true,
								change: function(color) {
									thisClass.setElementParameters(currentElement, {currentColor: color.toHexString()});
								}
							});

							_updateSpectrum();
						}
					}

					_toggleOptionField($colorPicker, true);
					_toggleOptionField($contextDialog.find('.fpd-opacity-slider'), true);
				}


				//text options
				if(currentElement.type == "i-text"  || currentElement.type == 'curvedText') {

					_toggleOptionField($contextDialog.find('.fpd-patterns'), elemParams.patternable && options.patterns.length);
					_toggleOptionField($contextDialog.find('.fpd-change-text'), elemParams.editable);
					_toggleOptionField($contextDialog.find('.fpd-fonts-dropdown'), elemParams.editable && options.fonts && options.fonts.length > 0);
					_toggleOptionField($contextDialog.find('.fpd-line-height-slider'), elemParams.editable);
					_toggleOptionField($contextDialog.find('.fpd-text-align-left'), elemParams.editable);
					_toggleOptionField($contextDialog.find('.fpd-text-style-bold'), elemParams.editable);


					if(elemParams.curvable) {

						_toggleOptionField($contextDialog.find('.fpd-curved-text-switcher').toggleClass('fpd-checked', elemParams.curved), true);

						if(elemParams.curved) {
							_toggleOptionField($contextDialog.find('.fpd-curved-text-radius-slider'), true);
							_toggleOptionField($contextDialog.find('.fpd-curved-text-spacing-slider'), true);
							_toggleOptionField($contextDialog.find('.fpd-curved-text-reverse-switcher'), true);
							$contextDialog.find('.fpd-curved-text-options:gt(0)').toggleClass('fpd-hidden', !$contextDialog.find('.fpd-curved-text-switcher').hasClass('fpd-checked'));
						}


					}

				}
				else {
					if(elemParams.filters && elemParams.filters.length > 0 && currentElement.type == 'image') {

						//show filter container
						$contextDialog.find('.fpd-filter-options').removeClass('fpd-hidden')
						//hide filter options
						.find('.fpd-item:gt(0)').addClass('fpd-hidden');

						//show available filter options
						for(var i=0; i<elemParams.filters.length; ++i) {
							$contextDialog.find('.fpd-filter-options')
							.find('.fpd-filter-'+elemParams.filters[i]).removeClass('fpd-hidden');
						}

					}

				}

				//TRANSFORMS
				_toggleOptionField($contextDialog.find('.fpd-angle-slider'), elemParams.rotatable);
				_toggleOptionField($contextDialog.find('.fpd-scale-slider'), elemParams.resizable);

				//HELPERS
				$contextDialog.find('.fpd-moveLayer-options').toggleClass('fpd-hidden', !elemParams.zChangeable);
				$contextDialog.find('.fpd-alignment-options').toggleClass('fpd-hidden', !elemParams.draggable);
				$contextDialog.find('.fpd-flip-options').toggleClass('fpd-hidden', !elemParams.resizable);
				$contextDialog.find('.fpd-helper-btns').removeClass('fpd-hidden');


				//check for a boundingbox
				if(elemParams.boundingBox && !options.editorMode) {

					var bbCoords = thisClass.getBoundingBoxCoords(currentElement);
					if(bbCoords) {
						currentBoundingObject = new fabric.Rect({
							left: bbCoords.left,
							top: bbCoords.top,
							width: bbCoords.width,
							height: bbCoords.height,
							stroke: options.boundingBoxColor,
							strokeWidth: 1,
							fill: false,
							selectable: false,
							evented: false,
							originX: 'left',
							originY: 'top',
							name: "bounding-box",
							params: {
								x: bbCoords.left,
								y: bbCoords.top,
								scale: 1
							}
						});

						stage.add(currentBoundingObject);
						currentBoundingObject.bringToFront();
					}
				}

				_updateEditUI();
				_positionElements(responsiveScale);
				_checkContainment(currentElement);
				_updateEditorBox(currentElement);
				_resetUndoRedo();

				/**
			     * Gets fired as soon as an element is selected.
			     *
			     * @event FancyProductDesigner#elementSelect
			     * @param {Event} event
			     * @param {fabric.Object} currentElement - The current selected element.
			     */

				$elem.trigger('elementSelect', [currentElement]);
			}
		});


		_initContextDialog();

	};

	var _initContextDialog = function() {

		//make dialog draggable

		$contextDialog.addClass('fpd-'+options.dialogBoxPositioning);
		if(options.dialogBoxPositioning == 'dynamic') {

			$contextDialog
			.draggable({
				handle: $contextDialog.find('.fpd-dialog-head'),
				drag: function(evt, ui) {
					if(ui.offset.top <= 0) {
						ui.position.top = 0;
					}
					$colorPicker.find('input').spectrum('reflow');
				}
			})
			.resizable({
				resize: function() {
					_setDynamicColumns();
				},
				stop: function() {
					_refreshLazyLoad(false);
				}
			});

		}
		else if(options.dialogBoxPositioning == 'left' || options.dialogBoxPositioning == 'right') {
			$contextDialog.addClass('fpd-fixed');
		}

		//deselect element when closing dialog
		$contextDialog.find('.fpd-dialog-head .fpd-close-dialog').click(function() {

			thisClass.deselectElement();
			thisClass.closeDialog();

		});

		$contextDialog.find('.fpd-content-back').click(function() {

			$(this).removeClass('fpd-show');
			$contextDialog.find('.fpd-content-sub.fpd-show').removeClass('fpd-show');
			_setDialogTitle($contextDialog.find('.fpd-content-back').data('parentTitle'));

		});

		//select associated element on stage when choosing one from the layers list
		$contextDialog.on('click', '.fpd-content-layers .fpd-list-row', function() {

			if($(this).hasClass('fpd-locked')) {
				return false;
			}

			var objects = stage.getObjects();
			for(var i=0; i < objects.length; ++i) {
				if(objects[i].id == this.id) {
					stage.setActiveObject(objects[i]);
					break;
				}
			}

		});

		//remove element
		$contextDialog.on('click', '.fpd-content-layers .fpd-lock-element',function(evt) {

			evt.stopPropagation();

			var $this = $(this),
				element = _getElementByID($this.parents('.fpd-list-row').attr('id'));

			//lock element
			if(element.evented) {
				element.evented = false;
				$this.children('i').removeClass('fpd-icon-unlocked').addClass('fpd-icon-locked');
				$this.parents('.fpd-list-row').addClass('fpd-locked')
				.children('div:lt(2)').css('opacity', 0.2).css('pointer-events', 'none');
			}
			//unlock
			else {
				element.evented = true;
				$this.children('i').removeClass('fpd-icon-locked').addClass('fpd-icon-unlocked');
				$this.parents('.fpd-list-row').removeClass('fpd-locked')
				.children('div:lt(2)').css('opacity', 1).css('pointer-events', 'visible');
			}

			$this.tooltipster('content', element.evented ? options.labels.lock : options.labels.unlock);
			$this.parents('.fpd-list:first').sortable( 'refresh' );

		});

		//remove element
		$contextDialog.on('click', '.fpd-content-layers .fpd-remove-element',function(evt) {

			evt.stopPropagation();
			thisClass.removeElement($(this).parents('.fpd-list-row').children('.fpd-cell-1').text());

		});

		//sortable layers list
		var draggedElement;
		$contextDialog.find( ".fpd-content-layers .fpd-list" ).sortable({
			handle: '.fpd-icon-reorder',
			placeholder: 'fpd-sortable-placeholder',
			scroll: true,
			axis: 'y',
			items: '.fpd-list-row:not(.fpd-locked)',
			start: function(evt, ui) {

				tempLayerListItemTop = ui.originalPosition.top;
				ui.placeholder.addClass('fpd-list-row').html('<div></div>');

				draggedElement = null;
				var objects = stage.getObjects();
				for(var i=0; i < objects.length; ++i) {
					if(objects[i].id == ui.item.attr('id')) {
						draggedElement = objects[i];
						break;
					}
				}
			},
			change: function(evt, ui) {

				//get next element in list, but not if its the sortable helper
				if(ui.position.top < tempLayerListItemTop) {
					//use when decreasing z
					var indexElement = ui.placeholder.nextAll('.fpd-list-row:not(.ui-sortable-helper):first');
				}
				else {
					//use when increasing z
					var indexElement = ui.placeholder.prevAll('.fpd-list-row:not(.ui-sortable-helper):first');
				}

				tempLayerListItemTop = ui.position.top;

				var newZ = 0;
				//last position, use length of objects in stage
				if(indexElement.size() === 0) {
					newZ = stage.getObjects().length-1;
				}
				else {
					//get index of object of all objects
					newZ = stage.getObjects().indexOf(_getElementByID(indexElement.attr('id')));
					//last position, decrease by one
					if(indexElement.is(ui.placeholder.nextAll('.fpd-list-row:not(.ui-sortable-helper):last'))) {
						newZ--;
					}

				}
				//z always >= 0
				newZ = newZ < 0 ? 0 : newZ;
				if(draggedElement) {
					draggedElement.moveTo(newZ);
				}


			}
		});

		//trigger click on input upload
		var $imageInput = $contextDialog.find('.fpd-input-image');
		$contextDialog.find('.fpd-add-image').click(function(evt) {

			evt.preventDefault();
			$imageInput.click();

		});

		//listen when input upload changes
		$contextDialog.find('.fpd-upload-form').on('change', function(evt) {

			if(window.FileReader) {

				var reader = new FileReader();
				var designTitle = evt.target.files[0].name;
		    	reader.readAsDataURL(evt.target.files[0]);

		    	reader.onload = function (evt) {
					thisClass.addCustomImage(evt.target.result, designTitle);
				}

			}

			$imageInput.val('');

		});

		//add custom text
		$contextDialog.find('.fpd-add-text').click(function() {

			var $inputText = $(this).children('.fpd-input-text');

			$inputText.addClass('fpd-show-up').children('input').focus();

			setTimeout(function() {
				$inputText.children('input').focus();
			}, 100);

		});

		$contextDialog.find('.fpd-input-text > .fpd-btn').click(function(evt) {

        	evt.stopPropagation();

			var $input = $(this).prev('input:first'),
				text = $input.val();

			if(text && text.length > 0) {

				var textParams = $.extend({}, viewOptions.customTextParameters, {isCustom: true});
				thisClass.addElement(
					'text',
					text,
					text,
					textParams,
					currentViewIndex
				);
			}

			$contextDialog.find('.fpd-add-text .fpd-input-text').removeClass('fpd-show-up');
			$input.val('');

		});

		$contextDialog.find('.fpd-input-text > input').keyup(function(evt){

		    if(evt.keyCode == 13) {
		    	$contextDialog.find('.fpd-input-text > .fpd-btn').click();
		    }

		});

		//check if user can add photos from facebook
		if(options.facebookAppId && options.facebookAppId.length > 0) {

			var $fbPhotoGrid = $contextDialog.find('.fpd-add-facebook-photo-wrapper .fpd-grid');

			var $fbAlbumsSelect = $contextDialog.find('.fpd-fb-user-albums').change(function() {

				$contextLoader.show();

				var albumId = $(this).children('option:selected').val();

				$fbPhotoGrid.children('.fpd-item').remove();

				//get photos from fb album
				FB.api('/'+albumId+'?fields=count', function(response) {

					var albumCount = response.count;

					FB.api('/'+albumId+'?fields=photos.limit('+albumCount+').fields(source,images)', function(response) {

						if(!response.error) {
							var photos = response.photos.data;

							for(var i=0; i < photos.length; ++i) {
								var photo = photos[i],
									photoImg = photo.images[photo.images.length-1] ? photo.images[photo.images.length-1].source : photo.source;

								var $lastItem = $fbPhotoGrid.append('<div class="fpd-item" data-picture="'+photo.source+'" title="'+photo.id+'"><picture></picture></div>')
								.children('.fpd-item:last').click(function(evt) {

									evt.preventDefault();
									$fullLoader.show();

									var $this = $(this);

									var $this = $(this),
										ajaxSettings = options.socialPhotoAjaxSettings;

									ajaxSettings.data.url = $this.data('picture');
									ajaxSettings.success = function(data) {

										if(data && data.error == undefined) {

											var picture = new Image();
											picture.src = data.image_src;
											picture.onload = function() {

												options.customImageParameters.scale = thisClass.getScalingByDimesions(
													this.width,
													this.height,
													options.customImageParameters.resizeToW,
													options.customImageParameters.resizeToH
												);

												thisClass.addCustomImage( this.src, $this.attr('title') );
											};

										}
										else {

											$fullLoader.hide();
											thisClass.showModal(data.error);

										}

									};

									//ajax post
									$.ajax(ajaxSettings)
									.fail(function(evt) {

										$fullLoader.hide();
										thisClass.showModal(evt.statusText);

									});

								});

								_loadImage($lastItem.children('picture'), photoImg);
								_createScrollbar($fbPhotoGrid.parent());

							}
						}

						$contextLoader.hide();

					});

				});

			});

			$contextDialog.find('.fpd-add-facebook-photo').click(function() {
				thisClass.callDialogContent('adds', $(this).children('span').text(), 'facebook');
				$fbAlbumsSelect.change();
			});

			$.ajaxSetup({ cache: true });
			$.getScript('//connect.facebook.com/en_US/sdk.js', function(){

				//init facebook
				FB.init({
					appId: options.facebookAppId,
					status: true,
					cookie: true,
					xfbml: true,
					version: 'v2.0'
				});

				FB.Event.subscribe('auth.statusChange', function(response) {

					if (response.status === 'connected') {
						// the user is logged in and has authenticated your app

						$contextLoader.show();

						FB.api('/me/albums', function(response) {

							var albums = response.data;
							//add all albums to select
							for(var i=0; i < albums.length; ++i) {
								var album = albums[i];
								$fbAlbumsSelect.append('<option value="'+album.id+'">'+album.name+'</option>').nextAll('.select2').show();
							}

							$contextLoader.hide();
						});

					}
					else {
						// the user isn't logged into Facebook.
						$fbPhotoGrid.children('.fpd-item').remove();
						$fbAlbumsSelect.empty().val('').change().nextAll('.select2').hide();
					}

				});

			});
		}


		//instagram
		if(options.instagramClientId.length) {

			$contextDialog.find('.fpd-add-instagram-photo').click(function() {
				$contextDialog.find('.fpd-insta-feed').click();
				thisClass.callDialogContent('adds', $(this).children('span').text(), 'instagram');
			});

			$contextDialog.find('.fpd-insta-feed, .fpd-insta-recent-images').click(function(evt) {

				evt.preventDefault();
				var $this = $(this),
					endpoint = $this.hasClass('fpd-insta-feed') ? 'feed' : 'recent';

				//check if access token is stored in browser
				instaAccessToken = window.localStorage.getItem('fpd_instagram_access_token');
				if(!localStorageAvailable || instaAccessToken == null) {
					_authenticateInstagram(function() {
						_loadInstaImages(endpoint);
					});
				}
				//load images by requested endpoint
				else {
					_loadInstaImages(endpoint);
				}
			});

		}

		//load all designs
		if($designs.size() > 0) {

			$contextDialog.find('.fpd-add-design').click(function() {
				thisClass.callDialogContent('adds', $(this).children('span').text(), 'designs');
			});

			//check if categories are used
			if($designs.children('.fpd-category').length > 1) {

				//categories are found
				//create design dropdown
				$designCategories = $contextDialog.find('.fpd-add-design-wrapper .fpd-content-head').append('<select class="fpd-design-categories" tabindex="1"></select>')
				.children('.fpd-design-categories').change(function() {

					//get designs from selected category
					var designsInCat = designCategories[this.value];

					//empty list
					$contextDialog.find('.fpd-add-design-wrapper .fpd-grid > .fpd-item').remove();

					//add designs from category to list
					for(var i=0; i < designsInCat.length; ++i) {
						_addGridDesign(designsInCat[i]);
					}

					_refreshLazyLoad(false);

				});

				//browse through all categories
				$designs.children('.fpd-category').each(function(i, cat) {

					var $cat = $(cat),
						categoryParams = $cat.data('parameters') ? $cat.data('parameters') : {};

					$cat.children('img').each(function(j, design) {
						var $design = $(design);
						thisClass.addDesign(
							$design.data('src') == undefined ? $design.attr('src') : $design.data('src'),
							$design.attr('title'),
							$.extend({}, categoryParams, $design.data('parameters')),
							cat.title,
							$design.data('thumbnail')
						);
					});

				});

			}
			else {

				$contextDialog.find('.fpd-add-design-wrapper').addClass('fpd-no-categories');

				//append designs to list
				var $designImgs = $designs.find('img');
				for(var i=0; i < $designImgs.length; ++i) {
					var $design = $($designImgs[i]);
					thisClass.addDesign(
						$design.data('src') == undefined ? $design.attr('src') : $design.data('src'),
						$design.attr('title'),
						$design.data('parameters'),
						false,
						$design.data('thumbnail')
					);
				}
			}

			$designs.remove();
		}

		//************ EDIT FORM ****************

		//patterns
		if(options.patterns && options.patterns.length > 0) {

			for(var i=0; i < options.patterns.length; ++i) {
				var patternUrl = options.patterns[i];
				$contextDialog.find('.fpd-patterns > .fpd-grid').append('<div class="fpd-item" data-pattern="'+patternUrl+'"><picture style="background-image: url('+patternUrl+');"></picture></div>')
				.children(':last').click(function() {

					thisClass.setElementParameters(currentElement, {
							pattern: $(this).data('pattern')
						}
					);

				});
			}

		}

		//opacity
		$contextDialog.find('.fpd-opacity-slider').on('slide', function(evt, ui) {

			thisClass.setElementParameters(currentElement, {opacity: ui.value });

		});

		//change text
		$contextDialog.find('.fpd-change-text').keyup(function() {

			thisClass.setElementParameters(currentElement, {text: this.value});

		});

		$contextDialog.find('.fpd-filter-options .fpd-item').click(function() {

			thisClass.setElementParameters(currentElement, {filter: $(this).data('filter')});

		});

		if(options.fonts.length > 0) {

			//change font family when dropdown changes
			$contextDialog.find('.fpd-fonts-dropdown').change(function() {

				thisClass.setElementParameters(currentElement, {font: this.value});

			});

			options.fonts.sort();
			for(var i=0; i < options.fonts.length; ++i) {
				var fontName = options.fonts[i].indexOf(':') == -1 ? options.fonts[i] : options.fonts[i].substring(0, options.fonts[i].indexOf(':'));
				if($contextDialog.find('.fpd-fonts-dropdown').children('option[value="'+fontName+'"]').size() == 0) {
					$contextDialog.find('.fpd-fonts-dropdown').append('<option value="'+fontName+'" style="font-family: '+fontName+';">'+fontName+'</option>');
				}
			}

			//set font family in font dropdown for every option
			$contextDialog.find('.fpd-fonts-dropdown').on('select2:open', function() {

				$(this).children('option').each(function(i, item) {
					$('.select2-results').find('li').eq(i).css('font-family', item.value);
				});

			});

		}

		//change line-height
		$contextDialog.find('.fpd-line-height-slider').on('slide', function(evt, ui) {

			thisClass.setElementParameters(currentElement, {lineHeight: ui.value });

		});

		//change alignment
		$contextDialog.find('.fpd-set-alignment .fpd-btn').click(function(evt) {

			evt.preventDefault();
			var $this = $(this);

			if($this.hasClass('fpd-text-align-left')) {
				thisClass.setElementParameters(currentElement, {textAlign: 'left'});
			}
			else if($this.hasClass('fpd-text-align-center')) {
				thisClass.setElementParameters(currentElement, {textAlign: 'center'});
			}
			else if($this.hasClass('fpd-text-align-right')) {
				thisClass.setElementParameters(currentElement, {textAlign: 'right'});
			}

			if(currentElement.type == 'curvedText') {
				currentElement.setFill(currentElement.fill);
			}

			stage.renderAll();

		});

		//change style
		$contextDialog.find('.fpd-set-style .fpd-btn').click(function(evt) {

			evt.preventDefault();
			var $this = $(this);

			if($this.hasClass('fpd-text-style-bold')) {
				thisClass.setElementParameters(currentElement, {fontWeight: currentElement.getFontWeight() == 'bold' ? 'normal' : 'bold'});
			}
			else if($this.hasClass('fpd-text-style-italic')) {
				thisClass.setElementParameters(currentElement, {fontStyle: currentElement.getFontStyle() == 'italic' ? 'normal' : 'italic'});
			}
			else if($this.hasClass('fpd-text-style-underline')) {
				thisClass.setElementParameters(currentElement, {textDecoration: currentElement.getTextDecoration() == 'underline' ? 'normal' : 'underline'});
			}

			//call setfill again, otherwise font styles are not attached to curved text
			if(currentElement.type == 'curvedText') {
				currentElement.setFill(currentElement.fill);
			}

			stage.renderAll();

		});

		//change angle
		$contextDialog.find('.fpd-angle-slider').on('slide', function(evt, ui) {

			thisClass.setElementParameters(currentElement, {degree: ui.value });

		});

		//change angle
		$contextDialog.find('.fpd-scale-slider').on('slide', function(evt, ui) {

			thisClass.setElementParameters(currentElement, {scale: ui.value });

		});

		//move layer
		$contextDialog.find('.fpd-move-up, .fpd-move-down').click(function(evt) {

			var $this = $(this),
				$list = $contextDialog.find( ".fpd-content-layers .fpd-list" ),
				$listItem = $list.children('[id="'+currentElement.id+'"]');

			if($this.hasClass('fpd-move-down')) {

				if($listItem.prev('div').size() > 0) {
					$listItem.insertBefore($listItem.prev('div:first'));
					var indexElement = $listItem.nextAll('.fpd-list-row:not(.ui-sortable-helper):first'),
						newZ = stage.getObjects().indexOf(_getElementByID(indexElement.attr('id')));

					currentElement.moveTo(newZ);
				}

			}
			else {

				if($listItem.next('div').size() > 0) {
					$listItem.insertAfter($listItem.next('div:first'));
					var indexElement = $listItem.prevAll('.fpd-list-row:not(.ui-sortable-helper):first'),
						newZ = stage.getObjects().indexOf(_getElementByID(indexElement.attr('id')));

					currentElement.moveTo(newZ);
				}

			}

		});

		//center element
		$contextDialog.find('.fpd-center-horizontal, .fpd-center-vertical').click(function(evt) {

			var $this = $(this);
			_centerObject(currentElement, $this.hasClass('fpd-center-horizontal'), $this.hasClass('fpd-center-vertical'), currentBoundingObject ? thisClass.getBoundingBoxCoords(currentElement) : false);

		});

		//toggle normal text/curved text
		$contextDialog.find('.fpd-curved-text-switcher').click(function() {

			var z = _getZIndex(currentElement),
				defaultText = currentElement.getText(),
				params = currentElement.params;

			params.z = z;
			params.curved = currentElement.type == 'i-text';
			params.textAlign = 'center';

			function _onTextModeChanged(evt, textElement) {
				stage.setActiveObject(textElement);
				$elem.off('elementAdded', _onTextModeChanged);
			};
			$elem.on('elementAdded', _onTextModeChanged);

			thisClass.removeElement(currentElement);
			thisClass.addElement('text', defaultText, defaultText, params);

		});

		//set radius for curved text
		$contextDialog.find('.fpd-curved-text-radius-slider').on('slide', function(evt, ui) {

			if(currentElement && currentElement.params.curved) {
				thisClass.setElementParameters(currentElement, {curveRadius: ui.value });
			}

		});

		//set spacing for curved text
		$contextDialog.find('.fpd-curved-text-spacing-slider').on('slide', function(evt, ui) {

			if(currentElement && currentElement.params.curved) {
				thisClass.setElementParameters(currentElement, {curveSpacing: ui.value });
			}

		});

		//toggle reverese for curved text
		$contextDialog.find('.fpd-curved-text-reverse-switcher').click(function() {

			if(currentElement && currentElement.params.curved) {
				$(this).toggleClass('fpd-checked');
				thisClass.setElementParameters(currentElement, {curveReverse: $(this).hasClass('fpd-checked') });
			}

		});

		//set flipX/flipY
		$contextDialog.find('.fpd-flip-horizontal, .fpd-flip-vertical').click(function() {

			if($(this).hasClass('fpd-flip-horizontal')) {
				thisClass.setElementParameters(currentElement, {flipX: !currentElement.flipX });
			}
			else {
				thisClass.setElementParameters(currentElement, {flipY: !currentElement.flipY });
			}

		});

		//reset element to his origin
		$contextDialog.find('.fpd-reset-element').click(function() {

			if(currentElement) {

				var originParams = currentElement.originParams,
					tempElement = currentElement;

				var resetParams = {
					x: originParams.x,
					y: originParams.y,
					currentColor: originParams.currentColor,
					degree: originParams.degree,
					opacity: originParams.opacity,
					scale: originParams.scale
				}

				if(originParams.text !== undefined) {
					resetParams.text = originParams.text;
					resetParams.font = originParams.font;
					resetParams.lineHeight = originParams.lineHeight;
					resetParams.textAlign = originParams.textAlign;
					resetParams.fontWeight = originParams.fontWeight;
					resetParams.fontStyle = originParams.fontStyle;
					resetParams.curveSpacing = originParams.curveSpacing;
					resetParams.curveRadius = originParams.curveRadius;
				}

				thisClass.deselectElement();
				thisClass.setElementParameters(tempElement, resetParams);

				if(originParams.autoCenter) {
					_doCentering(tempElement);
				}

				stage.setActiveObject(tempElement);

				if(originParams.colors && originParams.currentColor != originParams.colors[0]) {
					//if svg, return color array
					var colors = tempElement.type == 'path-group' ? originParams.colors : originParams.colors[0];
					thisClass.setElementParameters(tempElement, {currentColor: colors});
					stage.renderAll();
			    }

			    _resetUndoRedo();
			    $(this).tooltipster('hide');

			}

		});

		_setup();

	};

	var _setup = function() {

		//check if categories are used
		if($products.is('.fpd-category') && $products.filter('.fpd-category').size() > 1) {

			//categories are found
			$productCategories = $contextDialog.find('.fpd-content-products .fpd-content-head').append('<select class="fpd-product-categories"></select>')
			.children('.fpd-product-categories').change(function() {

				currentProductIndex = -1;

				//get products from selected category
				var productsInCat = productCategories[this.value];

				//empty list
				$contextDialog.find('.fpd-content-products .fpd-grid > .fpd-item').remove();

				//add products from category to grid
				for(var i=0; i < productsInCat.length; ++i) {
					_addGridProduct(productsInCat[i]);
				}

				_refreshLazyLoad(false);

			});

			//loop through all categories
			$products.each(function(i, cat) {
				var $cat = $(cat);
				_createProductsFromHTML($cat.children('.fpd-product'), $cat.attr('title'));
			});

		}
		else {

			//no categories are used
			$contextDialog.find('.fpd-content-products').addClass('fpd-no-categories');
			$products = $products.filter('.fpd-category').size() === 0 ? $products : $products.children('.fpd-product');
			_createProductsFromHTML($products, false);

		}

		//create UI sliders
		$body.find('.fpd-slider').each(function(i, slider) {

			var $slider = $(slider);
			$slider.slider({
				range: "min",
				value: $slider.data('value'),
				min: $slider.data('min'),
				max: $slider.data('max'),
				step: $slider.data('step')
			});

			//add color classes
			$slider.find('.ui-slider-range, .ui-slider-handle')
			.addClass('fpd-secondary-bg-color fpd-secondary-text-color');

		});

		//create UI selectbox
		$contextDialog.find('select').select2({
			width: '100%',
			dir: $body.css('direction')
		});

		//tabs
		$contextDialog.find('.fpd-tabs > .fpd-btn').click(function() {

			var $this = $(this);
			$this.parent().children('.fpd-btn').removeClass('fpd-checked');
			$this.addClass('fpd-checked');

		});

		//switchers
		$contextDialog.find('.fpd-switch-container').click(function() {

			var $this = $(this);

			if($this.hasClass('fpd-curved-text-switcher')) {

				$contextDialog.find('.fpd-curved-text-options:gt(0)').toggleClass('fpd-hidden', !$this.hasClass('fpd-checked'));

			}
		});

		//save the last modification when using a draggable option
		$body.mousedown(function() {
			startIndexUndo = undos.length;
		})
		.mouseup(function() {

			//timeout needed to store undos later after modification of an object
			setTimeout(function() {

				endIndexUndo = undos.length;
				//dragging was used
				if(startIndexUndo != endIndexUndo) {
					undos.splice(startIndexUndo+1, undos.length-1)
				}

				//toggle undo button
				$elem.find('.fpd-undo').toggleClass('fpd-disabled', undos.length == 0 || !currentElement);

			}, 5);

		});

		//prevent document scrolling when in dialog content
		$body.on({
		    'mousewheel': function(evt) {

		        if ($(evt.target).parents('.fpd-dialog-content').size() > 0) {
			    	evt.preventDefault();
				    evt.stopPropagation();
			    }

		    }
		});

		_createScrollbar($contextDialog.find('.fpd-content-layers, .fpd-content-edit, .fpd-content-saved-products, .fpd-content-products .fpd-content-main'));


		//load editor box if requested
		if(options.editorMode) {
			$.post(
				options.templatesDirectory+'editorbox.php',
				function(html){
					if(typeof options.editorMode === 'string') {
						$editorBox = $(options.editorMode).append($.parseHTML(html)).children('.fpd-editor-box');
					}
					else {
						$elem.after($.parseHTML(html));
						$editorBox = $elem.next('.fpd-editor-box');
					}

				}
			)
		}

		$initText.remove();
		$elem.addClass('fpd-show-up');

		//window resize handler
		$(window).resize(function() {
			_refreshDesignerSize();
			_setContextDialogPosition();
		});
		_refreshDesignerSize();
		_setContextDialogPosition();

		/**
	     * Gets fired as soon as the product designer is ready to receive API calls.
	     *
	     * @event FancyProductDesigner#ready
	     * @param {Event} event
	     */

		$elem.trigger('ready');

		//load first product
		if($contextDialog.find('.fpd-content-products .fpd-item:first').size() > 0 && !stageCleared) {
			$contextDialog.find('.fpd-content-products .fpd-item:first').click();
		}
		else {
			$fullLoader.hide();
		}

	};

	//creates all products from HTML markup
	var _createProductsFromHTML = function($products, category) {

		var views = [];
		for(var i=0; i < $products.length; ++i) {
			//get other views
			views = $($products.get(i)).children('.fpd-product');
			//get first view
			views.splice(0,0,$products.get(i));

			var viewsArr = [];
			views.each(function(i, view) {
				var $view = $(view);
				var viewObj = {
						title: view.title,
						thumbnail: $view.data('thumbnail'),
						elements: [],
						options: $view.data('options')
					};

				$view.children('img,span').each(function(j, element) {
					var $element = $(element),
						source;

					if($element.is('img')) {
						source = $element.data('src') == undefined ? $element.attr('src') : $element.data('src');
					}
					else {
						source = $element.text()
					}

					var elementObj = {
						type: $element.is('img') ? 'image' : 'text', //type
						source: source, //source
						title: $element.attr('title'),  //title
						parameters: $element.data('parameters') == undefined || $element.data('parameters').length <= 2 ? {} : $element.data('parameters')  //parameters
					};
					elementObj.parameters.isInitial = true;
					viewObj.elements.push(elementObj);
				});
				viewsArr.push(viewObj);
			});

			thisClass.addProduct(viewsArr, category);
		}

	};

	var _createSingleView = function(title, elements) {

		var element = elements[0];
		//check if view contains at least one element
		if(element) {
			var countElements = 0;
			//iterative function when element is added, add next one
			function _onElementAdded(evt, addedElement) {

				countElements++;

				//add all elements of a view
				if(countElements < elements.length) {
					var element = elements[countElements];
					thisClass.addElement( element.type, element.source, element.title, element.parameters, viewsLength-1);
				}
				//all elements are added
				else {
					$elem.off('elementAdded', _onElementAdded);

					/**
				     * Gets fired as soon as a view has been created.
				     *
				     * @event FancyProductDesigner#viewCreate
				     * @param {Event} event
				     * @param {string} title - The view title.
				     */
					$elem.trigger('viewCreate', [elements, title]);
				}

			};
			//listen when element is added
			$elem.on('elementAdded', _onElementAdded);
			//add first element of view
			thisClass.addElement( element.type, element.source, element.title, element.parameters, viewsLength-1);
		}
		//no elements in view, view is created without elements
		else {
			$elem.trigger('viewCreate', [elements, title]);
		}

	};

	//checks if an element is in his containment (bounding box)
	var _checkContainment = function(target) {

		if(currentBoundingObject && !target.params.boundingBoxClipping && !target.params.hasUploadZone) {

			//reset
			var objects = [currentBoundingObject, target];
			for(var i=0; i < objects.length; ++i) {
				objects[i].scaleX = objects[i].params.scale * responsiveScale;
				objects[i].scaleY = objects[i].params.scale * responsiveScale;
		        objects[i].left = objects[i].params.x * responsiveScale;
		        objects[i].top = objects[i].params.y * responsiveScale;
				objects[i].setCoords();
			}

			var targetCoordsTL = target.oCoords.tl,
				isOut = false,
				tempIsOut = target.isOut;

			var isOut = !target.isContainedWithinObject(currentBoundingObject);

			if(isOut) {
				target.borderColor = options.outOfBoundaryColor;
				if(options.tooltips ) {
					$elementTooltip.css({
						right: stage.getWidth() - targetCoordsTL.x - target.getWidth() * 0.5,
						top: targetCoordsTL.y - $elementTooltip.outerHeight() - 20
					}).show();
				}
				target.isOut = true;
			}
			else {
				target.borderColor = options.selectedColor;
				$elementTooltip.hide();
				target.isOut = false;
			}


			if(tempIsOut != target.isOut && tempIsOut != undefined) {
				if(isOut) {

					/**
				     * Gets fired as soon as an element is outside of its bounding box.
				     *
				     * @event FancyProductDesigner#elementOut
				     * @param {Event} event
				     */
					$elem.trigger('elementOut');
				}
				else {

					/**
				     * Gets fired as soon as an element is inside of its bounding box again.
				     *
				     * @event FancyProductDesigner#elementIn
				     * @param {Event} event
				     */
					$elem.trigger('elementIn');
				}
			}
		}

	};

	var _changeColor = function(element, hex, temp) {

		temp = typeof temp === 'undefined' ? false : temp;

		//check if hex color has only 4 digits, if yes, append 3 more
		if(hex.length == 4) {
			hex += hex.substr(1, hex.length);
		}

		//text
		if(element.type == 'i-text'  || element.type == 'curvedText') {
			hex = hex === false ? '#000000' : hex;
			//set color of a text element
			element.setFill(hex);
			stage.renderAll();
			if(temp == false) { element.params.pattern = null; }
			$colorPicker.find('input').spectrum("set", hex);
			_setColorPrice(element, hex);
		}
		//path groups (svg)
		else if(element.type == 'path-group' && typeof hex == 'object') {
			for(var i=0; i<hex.length; ++i) {
				element.paths[i].setFill(hex[i]);
				$colorPicker.find('input').eq(i).spectrum("set", hex[i]);
			}
		}
		//image
		else {

			var colorizable = _elementIsColorizable(element);
			//colorize png or dataurl image
			if(colorizable == 'png' || colorizable == 'dataurl') {

				if(hex == false) {
					element.filters = [];
				}
				else {
					element.filters.push(new fabric.Image.filters.Tint({color: hex}));
					_setColorPrice(element, hex);
				}

				try {
					element.applyFilters(function() {
						stage.renderAll();
						$body.mouseup();
					});
				}
				catch(evt) {
					thisClass.showModal("Image element could not be colorized. Please be sure that the image is hosted under the same domain and protocol, in which you are using the product designer!");
				}

			}
			//colorize svg
			else if(colorizable == 'svg') {
				element.setFill(hex);
			}

			$colorPicker.find('input').spectrum("set", hex);

		}

		if(temp == false) { element.params.currentColor = hex; }

		_checkColorControl(element, hex);

	};

	//sets the price for the element if it has color prices
	var _setColorPrice = function(element, hex) {

		if(element.params.colorPrices && typeof element.params.colors === 'object') {

			if(element.params.currentColorPrice !== undefined) {
				element.params.price -= element.params.currentColorPrice;
				currentPrice -= element.params.currentColorPrice;
			}

			var hexKey = hex.replace('#', '');
			if(element.params.colorPrices.hasOwnProperty(hexKey) || element.params.colorPrices.hasOwnProperty(hexKey.toUpperCase())) {

				var elementColorPrice = element.params.colorPrices[hexKey] === undefined ? element.params.colorPrices[hexKey.toUpperCase()] : element.params.colorPrices[hexKey];

				element.params.currentColorPrice = elementColorPrice;
				element.params.price += element.params.currentColorPrice;
				currentPrice += element.params.currentColorPrice;

			}
			else {
				element.params.currentColorPrice = 0;
			}

			$elem.trigger('priceChange', [element.params.price, currentPrice]);

		}

	};

	//checks if the color of another element is controlled by the current element color
	var _checkColorControl = function(object, color) {

		if(object.colorControlFor) {

			var objects = object.colorControlFor;
			for(var i=0; i < objects.length; ++i) {
				_changeColor(objects[i], color);
			}
		}

	};

	//returns an object with the saved products for the current showing product
	var _getSavedProducts = function() {

		return localStorageAvailable ? JSON.parse(window.localStorage.getItem($elem.attr('id'))) : false;

	};

	//check if key is valid and available
	var _checkStorageKey = function(key) {

		//check if a key is set
		if(key == null) { return -1; }
		//check if key is not empty
		else if(key == "") { return 0; }

		//everything is fine
		return 1;

	};

	var _doCentering = function(object) {

		_centerObject(object, true, true, thisClass.getBoundingBoxCoords(object));
		object.params.autoCenter = false;

	};

	//center object
	var _centerObject = function(object, hCenter, vCenter, boundingBox) {

		var left, top,
			centerPoint = object.getCenterPoint();

		if(hCenter) {

			if(boundingBox) {

				//originX = left
				if(object.originX == 'left') {
					left = boundingBox.left + boundingBox.width * 0.5 - object.width * 0.5;

				}
				//oringX = center
				else {
					left = boundingBox.left + boundingBox.width * 0.5;
				}

			}
			else {

				if(object.originX == 'left') {
					left = options.width * 0.5 - object.width * 0.5;
				}
				else {
					left = options.width * 0.5;
				}

			}

			object.left = left;

		}

		if(vCenter) {
			if(boundingBox) {

				//originX = left
				if(object.originX == 'left') {
					top = boundingBox.top + boundingBox.height * 0.5 - object.width * 0.5;
				}
				//oringX = center
				else {
					top = boundingBox.top + boundingBox.height * 0.5;
				}

			}
			else {

				if(object.originX == 'left') {
					top = options.stageHeight * 0.5 - object.height * 0.5;
				}
				else {
					top = options.stageHeight * 0.5;
				}

			}

			object.top = top;

		}

		_checkContainment(object);
		stage.renderAll();
		object.setCoords();

		if(left != undefined) {
			object.params.x = left;
		}

		if(top != undefined) {
			object.params.y = top;
		}

		_refreshDesignerSize();

	};

	//add a saved product to the load dialog
	var _addSavedProduct = function(thumbnail, product) {

		//create new list item
		var $gridWrapper = $contextDialog.find('.fpd-content-saved-products .fpd-grid');

		$gridWrapper.append('<div class="fpd-item"><picture style="background-image: url('+thumbnail+')" ></picture><div class="fpd-btn fpd-trans"><i class="fpd-icon-remove"></i></div></div>')
		.children('.fpd-item:last').click(function(evt) {

			thisClass.loadProduct($(this).data('product'));
			currentProductIndex = -1;

		}).data('product', product)
		.children('.fpd-btn').click(function(evt) {

			evt.stopPropagation();

			var $item = $(this).parent('.fpd-item'),
				index = $item.parent('.fpd-grid').children('.fpd-item').index($item.remove()),
				savedProducts = _getSavedProducts();

				savedProducts.splice(index, 1);

			window.localStorage.setItem($elem.attr('id'), JSON.stringify(savedProducts));

		});

	};

	//creates a scrollbar or updates it
	var _createScrollbar = function($target) {

		if($target.hasClass('mCSB_container')) {
			$target.mCustomScrollbar('scrollTo', 0);
		}
		else {
			$target.mCustomScrollbar({
				scrollbarPosition: 'outside',
				autoExpandScrollbar: true,
				autoHideScrollbar: true,
				scrollInertia: 200,
				callbacks: {
					onScrollStart: function() {
						$colorPicker.find('input').spectrum('hide');
					},
					whileScrolling: function() {
						if(this.mcs.topPct == 100) {
							_refreshLazyLoad(true);
						}
					}
				}
			});
		}

	};

	//updates the edit box with the parameter values
	var _updateEditorBox = function(element) {

		if($editorBox == undefined) {
			return false;
		}

		var params = element.params;
		$editorBox.find('.fpd-current-element').text(element.title);
		$editorBox.find('.fpd-position').text('x: ' + parseInt(params.x) + ' y: '+ parseInt(params.y));
		$editorBox.find('.fpd-dimensions').text('width: ' + Math.round(element.getWidth()) + ' height: '+ Math.round(element.getHeight()));
		$editorBox.find('.fpd-scale').text(Number(Number(params.scale) % 360).toFixed(2));
		$editorBox.find('.fpd-degree').text(parseInt(params.degree));
		$editorBox.find('.fpd-color').text(params.currentColor);

	};

	//loads custom fonts
	var _renderOnFontLoaded = function(fontName) {

		WebFont.load({
			custom: {
			  families: [fontName]
			},
			fontactive: function(familyName, fvd) {
				$body.mouseup();
				stage.renderAll();
			}
		});

	};

	//checks if an image can be colorized and returns the image type
	var _elementIsColorizable = function(element) {

		if(element.type == 'i-text'  || element.type == 'curvedText') {
			return 'text';
		}

		//check if url is a png or base64 encoded
		var imageParts = element.source.split('.');
		//its base64 encoded
		if(imageParts.length == 1) {
			//check if dataurl is png
			if(imageParts[0].search('data:image/png;') == -1) {
				element.params.currentColor = element.params.colors = false;
				return false;
			}
			else {
				return 'dataurl';
			}
		}
		//its a url
		else {
			//only png and svg are colorizable
			if($.inArray('png', imageParts) == -1 && $.inArray('svg', imageParts) == -1) {
				element.params.currentColor = element.params.colors = false;
				return false;
			}
			else {
				if($.inArray('svg', imageParts) == -1) {
					return 'png';
				}
				else {
					return 'svg';
				}
			}
		}
	};

	//sets the pattern for an object
	var _setPattern = function(element, url) {

		if(element.type == 'image') {

			//todo: find proper solution

		}
		else if(element.type == 'i-text'  || element.type == 'curvedText') {

			if(url) {
				fabric.util.loadImage(url, function(img) {

					element.setFill(new fabric.Pattern({
						source: img,
						repeat: 'repeat'
					}));
					stage.renderAll();
					$body.mouseup();
				});
			}
			else {
				var color = element.params.currentColor ? element.params.currentColor : element.params.colors[0];
				color = color ? color : '#000000';
				element.setFill(color);
			}

		}

	};

	//get the z-position of an element
	var _getZIndex = function(element) {

		var objects = stage.getObjects(),
			zCounter = 0;

		for(var i = 0; i < objects.length; ++i) {
			if(objects[i].visible) {
				if(element === objects[i]) {
					return zCounter;
					break;
				}
				zCounter++;
			}
		}

	};

	//set the z-index of an element
	var _setZIndex = function(element, z) {

		var objects = stage.getObjects(),
			viewZIndexes = 0;

		for(var i=0; i < objects.length; ++i) {
			var object = objects[i];
			//only objects of the current view
			if(object.visible && object.title !== undefined) {
				//detect when required z-index of view reached
				if(viewZIndexes == z) {
					element.moveTo(i);
					break;
				}
				viewZIndexes++;
			}
		}

		_bringToppedElementsToFront();

		//refresh layers list
		i++;
		var nextId = null;
		for(var j=i; j<objects.length; ++j) {
			//get next editable element
			var object = objects[j];
			if(object.isEditable) {
				nextId = object.id;
				break;
			}
		}

		if(nextId !== null) {
			var $nextEditable = _getLayerListItemByID(nextId),
				$targetListItem = _getLayerListItemByID(element.id);

			if($nextEditable && $targetListItem) {
				$targetListItem.insertBefore($nextEditable);
			}

		}

	};

	//adds a new product to the products grid
	var _addGridProduct = function(views) {

		//load product by click
		var $gridWrapper = $contextDialog.find('.fpd-content-products .fpd-grid'),
			lazyClass = options.lazyLoad ? 'fpd-hidden' : '';

		var $lastItem = $gridWrapper.append('<div class="fpd-item fpd-tooltip '+lazyClass+'" title="'+views[0].title+'"><picture data-img="'+views[0].thumbnail+'"></picture></div>')
		.children('.fpd-item:last').click(function(evt) {

			var $this = $(this),
				index = $gridWrapper.children('.fpd-item').index($this);

			thisClass.selectProduct(index);

			evt.preventDefault();

		}).data('views', views);


		if(!options.lazyLoad) {
			_loadImage($lastItem.children('picture'), views[0].thumbnail);
		}

		//show products button in main bar
		if($gridWrapper.children('.fpd-item').length == 2 || !$gridWrapper.parents('.fpd-no-categories').size() > 0) {
			$elem.find('[data-context="products"]').css('display', 'inline-block');
		}

		_updateTooltip();

	};

	//adds a new design to the designs grid
	var _addGridDesign = function(design) {

		var $designsGrid = $contextDialog.find('.fpd-add-design-wrapper .fpd-grid'),
			lazyClass = options.lazyLoad ? 'fpd-hidden' : '';

		var $lastItem = $designsGrid.append('<div class="fpd-item fpd-tooltip '+lazyClass+'" data-source="'+design.source+'" data-title="'+design.title+'" title="'+design.title+'"><picture data-img="'+design.thumbnail+'"></picture></div>')
		.children('.fpd-item:last').click(function(evt) {

			var $this = $(this),
				designParams = $this.data('parameters');

			designParams.isCustom = true;
			thisClass.addElement('image', $this.data('source'), $this.data('title'), designParams, currentViewIndex);

		}).data('parameters', design.parameters);

		if(!options.lazyLoad) {
			_loadImage($lastItem.children('picture'), design.thumbnail);
		}

		_createScrollbar($designsGrid.parent());
		_updateTooltip();

	};

	//log into instagram via a popup
	var _authenticateInstagram = function(callback) {

		var popupLeft = (window.screen.width - 700) / 2,
			popupTop = (window.screen.height - 500) / 2;

		var popup = window.open(options.phpDirectory+'/instagram_auth.php', '', 'width=700,height=500,left='+popupLeft+',top='+popupTop+'');
		_popupBlockerAlert(popup);

		popup.onload = new function() {

			if(window.location.hash.length == 0) {
				popup.open('https://instagram.com/oauth/authorize/?client_id='+options.instagramClientId+'&redirect_uri='+options.instagramRedirectUri+'&response_type=token', '_self');
			}

			var interval = setInterval(function() {
				try {
					if(popup.location.hash.length) {
						clearInterval(interval);
						instaAccessToken = popup.location.hash.slice(14);
						if(localStorageAvailable) {
							window.localStorage.setItem('fpd_instagram_access_token', instaAccessToken);
						}
						popup.close();
						if(callback != undefined && typeof callback == 'function') callback();
					}
				}
				catch(evt) {
					//permission denied
				}

			}, 100);
		}

	};

	//load photos from instagram using an endpoint
	var _loadInstaImages = function(endpoint) {

		$contextLoader.show();

		var endpointUrl;

		switch(endpoint) {
			case 'feed':
				endpointUrl = 'https://api.instagram.com/v1/users/self/feed?access_token='+instaAccessToken;
			break;
			case 'recent':
				endpointUrl = 'https://api.instagram.com/v1/users/self/media/recent?access_token='+instaAccessToken;
			break;
			default:
				endpointUrl = endpoint;
		}

		var $instaPhotosGrid = $contextDialog.find('.fpd-add-instagram-photo-wrapper .fpd-grid'),
			$instaLoadNext = $contextDialog.find('.fpd-add-instagram-photo-wrapper .fpd-insta-load-next');

		$instaPhotosGrid.children('.fpd-item').remove();

		$.ajax({
	        method: 'GET',
	        url: endpointUrl,
	        dataType: 'jsonp',
	        jsonp: 'callback',
	        jsonpCallback: 'jsonpcallback',
	        cache: false,
	        success: function(data) {

	        	if(data.data) {

	        		if(data.pagination && data.pagination.next_url) {
						$instaLoadNext.removeClass('fpd-disabled').data('href', data.pagination.next_url).off('click').on('click', function() {
							_loadInstaImages($(this).data('href'));
							$instaLoadNext.addClass('fpd-disabled').off('click');
						});
	        		}
	        		else {
		        		$instaLoadNext.addClass('fpd-disabled').off('click');
	        		}

		        	$.each(data.data, function(i, item) {
		        		if(item.type == 'image') {

			        		var $lastItem = $instaPhotosGrid.append('<div class="fpd-item" title="'+item.id+'" data-picture="'+item.images.standard_resolution.url+'"><picture></picture>')
			        		.children('.fpd-item:last').click(function(evt) {

								evt.preventDefault();
								$fullLoader.show();

								var $this = $(this),
									ajaxSettings = options.socialPhotoAjaxSettings;

								ajaxSettings.data.url = $this.data('picture');
								ajaxSettings.success = function(data) {

									if(data && data.error == undefined) {

										var picture = new Image();
										picture.src = data.image_src;
										picture.onload = function() {

											options.customImageParameters.scale = thisClass.getScalingByDimesions(
												this.width,
												this.height,
												options.customImageParameters.resizeToW,
												options.customImageParameters.resizeToH
											);

											thisClass.addCustomImage( this.src, $this.attr('title') );
										};

									}
									else {

										$fullLoader.hide();
										thisClass.showModal(data.error);

									}

								};

								//ajax post
								$.ajax(ajaxSettings)
								.fail(function(evt) {

									$fullLoader.hide();
									thisClass.showModal(evt.statusText);

								});

							});

		        		}

		        		if($lastItem !== undefined) {
			        		_loadImage($lastItem.children('picture'), item.images.thumbnail.url);
			        	}

		        		_createScrollbar($instaPhotosGrid.parent());

		            });

		            $contextLoader.hide();

	        	}
	        	else {
		        	_authenticateInstagram(function() {
			        	_loadInstaImages(endpoint);
		        	});
	        	}

	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	            thisClass.showModal("Could not load data from instagram. Please try again!");
	        }
	    });

	};

	//defines the clipping area
	var _clipElement = function(element) {

		var bbCoords = thisClass.getBoundingBoxCoords(element);
		if(bbCoords) {

			element.clippingRect = bbCoords;
			element.setClipTo(function(ctx) {
				_clipById(ctx, this);
			});

		}

	};

	//draws the clipping
	var _clipById = function (ctx, _this, scale) {

		scale = scale === undefined ? 1 : scale;

		var centerPoint = _this.getCenterPoint(),
			clipRect = _this.clippingRect,
			scaleXTo1 = (1 / _this.scaleX),
			scaleYTo1 = (1 / _this.scaleY);

	    ctx.save();
	    ctx.translate(0,0);
	    ctx.rotate(fabric.util.degreesToRadians(_this.angle * -1));
	    ctx.scale(scaleXTo1, scaleYTo1);
	    ctx.beginPath();
	    ctx.rect(
	        (clipRect.left * responsiveScale) - centerPoint.x,
	        (clipRect.top * responsiveScale) - centerPoint.y,
	        clipRect.width * responsiveScale * scale,
	        clipRect.height * responsiveScale * scale
	    );
	    ctx.fillStyle = 'transparent';
	    ctx.fill();
	    ctx.closePath();
	    ctx.restore();

	};

	//position elements by a given scale
	var _positionElements = function(scale) {

		var objects = stage.getObjects();

		for(var i = 0; i < objects.length; ++i) {
			var object = objects[i];
			if(object.params) {
				object.scaleX = object.params.scale * scale;
		        object.scaleY = object.params.scale * scale;
		        object.left = object.params.x * scale;
		        object.top = object.params.y * scale;
				object.setCoords();
			}
		}

		return objects;

	};

	//brings all topped elements to front
	var _bringToppedElementsToFront = function() {

		var objects = stage.getObjects(),
			bringToFrontObj = [];

		for(var i = 0; i < objects.length; ++i) {
			var object = objects[i];
			if(object.visible && object.params && object.params.topped) {
				bringToFrontObj.push(object);
			}
		}

		for(var i = 0; i < bringToFrontObj.length; ++i) {
			bringToFrontObj[i].bringToFront();
		}

	};

	//checks if the popup blocker is enabled
	var _popupBlockerAlert = function(popup) {

		if (popup == null || typeof(popup)=='undefined') {
			thisClass.showModal('Please disable your pop-up blocker and try again.');
		}

	};

	//checks if a string is an URL
	var _isUrl = function(s) {

		var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
		return regexp.test(s);

	};

	//updates the options based on the chosen view
	var _updateViewOptions = function(viewOpts) {

		viewOpts = typeof viewOpts === "object" ? viewOpts : {};

		viewOptions = $.extend({}, options, viewOpts);
		viewOptions.elementParameters = $.extend({}, options.elementParameters, viewOptions.elementParameters);
		viewOptions.textParameters = $.extend({}, options.textParameters, viewOptions.textParameters);
		viewOptions.imageParameters = $.extend({}, options.imageParameters, viewOptions.imageParameters);
		viewOptions.customTextParameters = $.extend({}, options.customTextParameters, viewOptions.customTextParameters);
		viewOptions.customImageParameters = $.extend({}, options.customImageParameters, viewOptions.customImageParameters);
		viewOptions.customAdds = $.extend({}, options.customAdds, viewOptions.customAdds);

		thisClass.setStageDimensions(viewOptions.width, viewOptions.stageHeight);

		_updateInterface(viewOptions);

	};

	//update the UI by given options
	var _updateInterface = function(opts) {

		opts = typeof opts == "object" ? opts : {};

		//toggle add options
		$contextDialog.find('.fpd-add-image').toggle(Boolean(opts.customAdds.uploads));
		$contextDialog.find('.fpd-add-text').toggle(Boolean(opts.customAdds.texts));
		$contextDialog.find('.fpd-add-facebook-photo').toggle(Boolean(opts.customAdds.facebook) && _notEmpty(options.facebookAppId));
		$contextDialog.find('.fpd-add-instagram-photo').toggle(Boolean(opts.customAdds.instagram) && _notEmpty(options.instagramClientId));
		$contextDialog.find('.fpd-add-design').toggle(Boolean(opts.customAdds.designs) && $contextDialog.find('.fpd-add-design-wrapper .fpd-item').size() > 0);

		//get all visible add options
		var visibleAdds = $contextDialog.find('.fpd-choose-add > .fpd-btn-raised').filter(function() {
			return $(this).css('display') != 'none';
		});

		//toggle adds button depending on visible add options
		if(visibleAdds.size() > 0) {
			$elem.find('[data-context="adds"]').css('display', 'inline-block');
		}
		else {
			$elem.find('[data-context="adds"]').css('display', 'none');
		}

	};

	var _notEmpty = function(value) {

		if(value === undefined || value === false || value.length == 0) {
			return false;
		}
		return true;

	};

	//update tooltip UI
	var _updateTooltip = function() {

		if(!options.tooltips) {
			return false;
		}

		$('.fpd-tooltip').each(function(i, tooltip) {

			var $tooltip = $(tooltip);
			if($tooltip.hasClass('tooltipstered')) {
				$tooltip.tooltipster('reposition');
			}
			else {
				$tooltip.tooltipster({
					offsetY: 0,
					position: 'bottom',
					theme: '.fpd-tooltip-theme',
					touchDevices: false
				});
			}

		});

	};

	//set the title in the dialog
	var _setDialogTitle = function(title) {

		$contextDialog.find('.fpd-dialog-title').text(title);

	};

	//append a list item to the layers list
	var _appendLayerItem = function(id, title, reorder, removable, isUploadZone, locked) {

		$elem.find('[data-context="layers"]').css('display', 'inline-block');

		var reorderHtml = '<i></i>';
		if(reorder) {
			reorderHtml = '<i class="fpd-icon-reorder"></i>';
		}

		var $layersList = $contextDialog.find('.fpd-content-layers .fpd-list');
		$layersList.append('<div class="fpd-list-row" id="'+id+'"><div class="fpd-cell-0">'+reorderHtml+'</div><div class="fpd-cell-1">'+title+'</div><div class="fpd-cell-2"></div></div>');

		if(isUploadZone) {
			$layersList.find('.fpd-list-row:last').addClass('fpd-add-layer')
			.find('.fpd-cell-2').append('<span><i class="fpd-icon-add"></i></span>');
		}
		else {

			var lockIcon = locked ? 'fpd-icon-locked' : 'fpd-icon-unlocked',
				lockTitle = locked ? options.labels.unlock : options.labels.lock;

			$layersList.find('.fpd-list-row:last .fpd-cell-2').append('<span class="fpd-lock-element fpd-tooltip" title="'+lockTitle+'"><i class="'+lockIcon+'"></i></span>');

			if(removable) {
				$layersList.find('.fpd-list-row:last .fpd-lock-element').after('<span class="fpd-remove-element fpd-tooltip" title="'+options.labels.remove+'"><i class="fpd-icon-remove"></i></span>');
			}

			$layersList.find('.fpd-list-row:last ').addClass(locked ? 'fpd-locked' : '')
			.children('div:lt(2)').css('opacity', locked ? 0.2 : 1).css('pointer-events', locked ? 'none' : 'visible');

		}

		$layersList.sortable( 'refresh' );

		_updateTooltip();

	};

	//gets an upload zone by title
	var _getUploadZone = function(title) {

		var objects = stage.getObjects();
		for(var i=0; i<objects.length; ++i) {
			if(objects[i].params.uploadZone && objects[i].title == title) {
				return objects[i];
				break;
			}
		}

	};

	//checks if browser is IE and return version number
	function _isIE() {

		var myNav = navigator.userAgent.toLowerCase();
		return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;

	};

	//toggles an option field
	var _toggleOptionField = function($option, show, value) {

		value = typeof value !== 'undefined' ? value : null;

		$option.parents('.fpd-list-row').toggleClass('fpd-hidden', !show);
		//get related head
		var $relatedHead = $option.parents('.fpd-list-row').prevAll('.fpd-head-options:first');
		//check if a sub option is visible, then show head as well
		if($relatedHead.nextUntil('.fpd-head-options', '.fpd-list-row:not(.fpd-hidden)').size() > 0) {
			$relatedHead.removeClass('fpd-hidden');
		}

		if(value !== null) {

			if($option.hasClass('fpd-slider')) {
				$option.slider('value', value);
			}
			else if(typeof $option.attr('value') !== typeof undefined && $option.attr('value') !== false) {
				$option.val(value).change();
			}

		}

	};

	//refresh whole product designer dimensions - make it responsive
	var _refreshDesignerSize = function() {

		responsiveScale = $elem.outerWidth() < options.width ? $elem.outerWidth() / options.width : 1;
		responsiveScale = Number(responsiveScale.toFixed(2));
		responsiveScale = responsiveScale > 1 ? 1 : responsiveScale;

		stage.setDimensions({width: $elem.width(), height: options.stageHeight * responsiveScale});
		$productStage.height(options.stageHeight * responsiveScale);

		_positionElements(responsiveScale);
		stage.renderAll().calcOffset();

	};

	//set the position of the context dialog
	var _setContextDialogPosition = function() {

		var contextDialogLeftPos = $mainContainer.offset().left,
			contextDialogTopPos = $mainContainer.offset().top;

		//dynamic position
		if(!$contextDialog.hasClass('fpd-fixed')) {

			if(currentElement === null) {
				contextDialogLeftPos += 20;
				contextDialogTopPos += 20;
			}
			else {

				var elementCenterPoint = currentElement.getCenterPoint(),
					maxLeft = $window.width() - $contextDialog.width(),
					maxTop = $mainContainer.offset().top + $mainContainer.height() - $contextDialog.height();

				if(elementCenterPoint.x < $elem.width() * 0.5) {
					contextDialogLeftPos += elementCenterPoint.x + (currentElement.getWidth() * 0.5) + options.paddingControl + 20;
				}
				else {
					contextDialogLeftPos += (elementCenterPoint.x - (currentElement.getWidth() * 0.5) - options.paddingControl - $contextDialog.width() - 20);
				}

				contextDialogTopPos += elementCenterPoint.y - (currentElement.getHeight() * 0.5);

				if(contextDialogLeftPos < 0) {
					contextDialogLeftPos = 0;
				}

				if(contextDialogLeftPos > maxLeft) {
					contextDialogLeftPos = maxLeft;
				}

				if(contextDialogTopPos > maxTop) {
					contextDialogTopPos = maxTop;
				}
				else if(contextDialogTopPos < 0) {
					contextDialogTopPos = 0;
				}

			}

		}

		//fixed position
		if($contextDialog.hasClass('fpd-left') || $contextDialog.hasClass('fpd-right')) {

			contextDialogLeftPos = $contextDialog.hasClass('fpd-left') ? $elem.offset().left+50 : $elem.width() + $elem.offset().left - $contextDialog.width()-50;
			contextDialogTopPos = $mainContainer.offset().top + $mainContainer.height() * 0.5 - $contextDialog.height() * 0.5;

		}

		if($window.width() < 568) {
			$contextDialog.addClass('fpd-mobile');
			contextDialogTopPos = $elem.offset().top + $elem.height() + 10;
		}
		else {
			$contextDialog.removeClass('fpd-mobile').
			contextDialogTopPos = $mainContainer.offset().top + 10;
		}

		$contextDialog.css({
			left: contextDialogLeftPos,
			top: contextDialogTopPos
		});

	};

	//return an element by ID
	var _getElementByID = function(id) {

		var objects = stage.getObjects();
		for(var i=0; i<objects.length; ++i) {
			if(objects[i].id == id) {
				return objects[i];
				break;
			}
		}

		return false;

	};

	//updates UI of spectrum colorpicker
	var _updateSpectrum = function() {

		$container = $('.sp-container');
		$container.find('.sp-choose').addClass('fpd-secondary-bg-color fpd-secondary-text-color')
		.html('<i class="fpd-icon-done"></i>');
		$container.find('.sp-cancel').html('<i class="fpd-icon-close"></i>');

	};

	//returns the fabrich filter
	var _getFabircFilter = function(type) {

		switch(type) {
			case 'grayscale':
				return new fabric.Image.filters.Grayscale();
			break;
			case 'sepia':
				return new fabric.Image.filters.Sepia();
			break;
			case 'sepia2':
				return new fabric.Image.filters.Sepia2();
			break;
		}

		return null;

	};

	//resets the undo/redo array
	var _resetUndoRedo = function() {

		$elem.find('.fpd-undo, .fpd-redo').addClass('fpd-disabled');
		undos = [];
		redos = [];

	};

	//updates the edit UI
	var _updateEditUI = function() {

		if(!currentElement) {
			return false;
		}

		var parameters = currentElement.params;

		if(parameters.opacity !== undefined) {
			$contextDialog.find('.fpd-opacity-slider').slider('value', parameters.opacity);
		}

		if(parameters.scale !== undefined) {
			$contextDialog.find('.fpd-scale-slider').slider('value', parameters.scale);
		}

		if(parameters.degree !== undefined) {
			$contextDialog.find('.fpd-angle-slider').slider('value', parameters.degree);
		}

		if(parameters.text !== undefined) {

			$contextDialog.find('.fpd-content-layers .fpd-list')
			.children('[id="'+currentElement.id+'"]').children('.fpd-cell-1').text(parameters.text);
			$contextDialog.find('.fpd-change-text').val(parameters.text).change();

		}

		if(parameters.font !== undefined) {
			$contextDialog.find('.fpd-fonts-dropdown').val(parameters.font)
			.next('.select2').find('.select2-selection__rendered').text(parameters.font);
		}

		if(parameters.lineHeight !== undefined) {
			$contextDialog.find('.fpd-line-height-slider').slider('value', parameters.lineHeight);
		}

		if(parameters.textAlign !== undefined) {
			$contextDialog.find('.fpd-set-alignment').children('.fpd-btn').removeClass('fpd-checked')
			.filter('.fpd-text-align-'+parameters.textAlign).addClass('fpd-checked');
		}

		if(parameters.fontWeight !== undefined) {
			$contextDialog.find('.fpd-text-style-bold').toggleClass('fpd-checked', parameters.fontWeight == 'bold');
		}

		if(parameters.fontStyle !== undefined) {
			$contextDialog.find('.fpd-text-style-italic').toggleClass('fpd-checked', parameters.fontStyle == 'italic');
		}

		if(parameters.textDecoration !== undefined) {
			$contextDialog.find('.fpd-text-style-underline').toggleClass('fpd-checked', parameters.textDecoration == 'underline');
		}


		if(parameters.curved) {

			if(parameters.curveRadius) {
				$contextDialog.find('.fpd-curved-text-radius-slider').slider('value', parameters.curveRadius);
			}

			if(parameters.curveSpacing) {
				$contextDialog.find('.fpd-curved-text-spacing-slider').slider('value', parameters.curveSpacing);
			}

			if(parameters.curveReverse !== undefined) {
				$contextDialog.find('.fpd-curved-text-reverse-switcher').toggleClass('fpd-checked', parameters.curveReverse);
			}

		}

	};

	//refresh the items using lazy load
	var _refreshLazyLoad = function(loadByCounter) {

		if($currentLazyLoadContainer == null || $currentLazyLoadContainer.size() == 0) {
			return false;
		}

		var $grid = $currentLazyLoadContainer.find('.fpd-grid'),
			$item = $grid.children('.fpd-item.fpd-hidden:first'),
			counter = 0,
			amount = loadByCounter ? 10 : 0;

		while((counter < amount || $grid.height()-10 < $grid.parents('.fpd-content-main').height()) && $item.size() > 0) {
			var $pic = $item.children('picture');
			$item.removeClass('fpd-hidden');
			_loadImage($pic, $pic.data('img'));
			$item = $item.next('.fpd-item.fpd-hidden');
			counter++;
		}

	};

	//set columns related to container width
	var _setDynamicColumns = function() {

		var contextWidth = $contextDialog.removeClass('fpd-columns-'+$contextDialog.data('columns')).width(),
			newColumns = 3;

		if(contextWidth > 199) {
			newColumns = 1;
		}

		if(contextWidth > 259) {
			newColumns = 2;
		}

		if(contextWidth > 349) {
			newColumns = 3;
		}

		if(contextWidth > 459) {
			newColumns = 4;
		}

		if(contextWidth > 559) {
			newColumns = 5;
		}

		$contextDialog.addClass('fpd-columns-'+newColumns).data('columns', newColumns);

	};

	//add a preloader icon to loading picture and load image
	var _loadImage = function($picture, source) {

		$picture.addClass('fpd-on-loading');
		var image = new Image();
		image.src = source;
		image.onload = function() {
			$picture.attr('data-img', '').removeClass('fpd-on-loading').fadeOut(0)
			.stop().fadeIn(200).css('background-image', 'url("'+this.src+'")');
		};

	};

	//returns a layer list item by id
	var _getLayerListItemByID = function(id) {

		var $item = $contextDialog.find('.fpd-content-layers .fpd-list-row').filter('[id="'+id+'"]');
		return $item.size() === 0 ? null : $item;

	};



	//----------------------------------
	// ------- PUBLIC METHODS ----------
	//----------------------------------


	/**
	 * Returns the bounding box of an element.
	 *
	 * @method getBoundingBoxCoords
	 * @param {fabric.Object} element A fabric object
	 * @return {Object | Boolean} The bounding box object with x,y,width and height or false.
	 */
	FancyProductDesigner.prototype.getBoundingBoxCoords = function(element) {

		var params = element.params;
		if(params.boundingBox || params.uploadZone) {
			var boundingBox;
			if(typeof params.boundingBox == "object") {
				return {
					left: params.boundingBox.x,
					top:params.boundingBox.y,
					width: params.boundingBox.width,
					height: params.boundingBox.height
				};
			}
			else {
				var objects = stage.getObjects();
				for(var i=0; i < objects.length; ++i) {
					//get all layers from first view
					var object = objects[i];
					if(params.boundingBox == object.title) {

						var bbRect = object.getBoundingRect();
						return {
							left: bbRect.left / responsiveScale,
							top: bbRect.top / responsiveScale,
							width: bbRect.width / responsiveScale,
							height: bbRect.height / responsiveScale
						};

						break;
					}
				}
			}
		}

		return false;

	};

	/**
	 * Returns the stage as JSON withn the viewIndex property of every element.
	 *
	 * @method getFabricJSON
	 * @return {Object} JSON object.
	 */
	FancyProductDesigner.prototype.getFabricJSON = function() {

		thisClass.deselectElement();
		var json = stage.toJSON(['viewIndex']);
		json.width = stage.width;
		json.height = stage.height;

		return json;

	};

	/**
	 * Returns the current price, which is the sum of all element prices.
	 *
	 * @method getPrice
	 * @return {number} The current price.
	 */
	FancyProductDesigner.prototype.getPrice = function() {

		return currentPrice;

	};

	/**
	 * Returns the current showing product with all views and elements in the views.
	 *
	 * @method getProduct
	 * @param {boolean} [onlyEditableElements=false] If true, only the editable elements will be returned.
	 * @return {array} An array with all views. A view is an object containing the title, thumbnail, custom options and elements. An element object contains the title, source, parameters and type.
	 */
	FancyProductDesigner.prototype.getProduct = function(onlyEditableElements) {
		 onlyEditableElements = typeof onlyEditableElements !== 'undefined' ? onlyEditableElements : false;

		thisClass.deselectElement();
		thisClass.resetZoom();

		//check if an element is out of his containment - todo: public variable that stores the elements which are out of their containments
		var objects = stage.getObjects();
		for(var i=0; i<objects.length;++i) {
			var object = objects[i];
			if(object.isOut) {
				thisClass.showModal('"'+object.title+'":' + options.labels.outOfContainmentAlert);
				return false;
			}
		}

		var product = [];
		//add views
		for(var i=0; i<currentViews.length; ++i) {
			var view = currentViews[i];
			product.push({title: view.title, thumbnail: view.thumbnail, elements: [], options: view.options});
		}

		for(var i=0; i<objects.length;++i) {
			var object = objects[i];
			var jsonItem = {title: object.title, source: object.source, parameters: object.params, type: (object.type == 'i-text' || object.type == 'curvedText') ? 'text' : 'image'};

			if(object.clipFor == undefined) {
				if(onlyEditableElements) {
					if(object.isEditable) {
						product[object.viewIndex].elements.push(jsonItem);
					}
				}
				else {
					product[object.viewIndex].elements.push(jsonItem);
				}
			}

		}

		//returns an array with all views
		return product;

	};


	/**
	 * Returns the scale value, which is set for the responsive calculation.
	 *
	 * @method getResponsiveScale
	 * @return {number} The responsive scale value.
	 */
	FancyProductDesigner.prototype.getResponsiveScale = function() {

		return responsiveScale;

	};

	/**
	 * Returns the views as data URL.
	 *
	 * @method getViewsDataURL
	 * @param {string} [format=png] The image format for the data URL. Allowed values 'png' and 'jpeg'.
	 * @param {string} [backgroundColor='transparent'] The background color as hexadecimal value. For 'png' you can also use 'transparent'.
	 * @param {number} [multiplier=1] Multiplier to scale by.
	 * @return {array} An array with all views as data URL string.
	 */
	FancyProductDesigner.prototype.getViewsDataURL = function(format, backgroundColor, multiplier) {

		format = typeof format !== 'undefined' ? format : 'png';
		backgroundColor = typeof backgroundColor !== 'undefined' ? backgroundColor : 'transparent';
		multiplier = typeof multiplier !== 'undefined' ? multiplier : 1;

		thisClass.deselectElement();
		thisClass.resetZoom();

		var dataURLs = [],
			tempStageWidth = stage.getWidth(),
			tempStageHeight = stage.getHeight(),
			tempResponsiveScale = responsiveScale;

		stage.setDimensions({width:options.width, height: options.stageHeight}).setBackgroundColor(backgroundColor, function() {

			responsiveScale = 1;
			var objects = _positionElements(1);

			for(var i=0; i<viewsLength;++i) {
				for(var j=0; j<objects.length; ++j) {
					var object = objects[j];
					object.visible = object.viewIndex == i;
				}
				try {
					dataURLs.push(stage.toDataURL({format: format, multiplier: multiplier}));
				}
				catch(evt) {
					thisClass.showModal("Error: Please be sure that the images are hosted under the same domain and protocol, in which you are using the product designer!");
				}

			}

			//hide elements again that are not in the current view index
			for(var i=0; i<objects.length; ++i) {
				var object = objects[i];
				object.visible = object.viewIndex == currentViewIndex;
			}

			responsiveScale = tempResponsiveScale;
			_positionElements(responsiveScale);
			stage.renderAll();
			stage.setDimensions({width: tempStageWidth, height: tempStageHeight}).setBackgroundColor('transparent').renderAll();

		});

		return dataURLs;

	};

	/**
	 * Returns the current visible view as SVG.
	 *
	 * @method getViewSVG
	 * @return {string} The current visible view as SVG.
	 */
	FancyProductDesigner.prototype.getViewSVG = function() {

		thisClass.deselectElement();
		thisClass.resetZoom();

		var tempStageWidth = stage.getWidth(),
			tempStageHeight = stage.getHeight(),
			tempResponsiveScale = responsiveScale;

		stage.setDimensions({width: options.width, height: options.stageHeight});

		responsiveScale = 1;
		_positionElements(1);

		for(var i=0; i < stage.getObjects().length; ++i) {
			var object = stage.getObjects()[i];
			if(object.type == 'path-group') {
				object.left = (object.params.x * 1) - object.getWidth() * 0.5;
				object.top = (object.params.y * 1) - object.getHeight() * 0.5;
				object.setCoords();
			}

		}

		var svg = stage.toSVG(),
			$svg = $(svg);

		$svg.children('rect').remove(); //remove bounding boxes
		$svg.children('g').children('[style*="visibility: hidden"]').parent('g').remove(); //remove hidden elements
		svg = $('<div>').append($svg.clone()).html().replace(/(?:\r\n|\r|\n)/g, ''); //replace all newlines

		for(var i=0; i < stage.getObjects().length; ++i) {
		var object = stage.getObjects()[i];
			if(object.type == 'path-group') {
				object.left = (object.params.x * responsiveScale);
				object.top = (object.params.y * responsiveScale);
				object.setCoords();
			}

		}

		responsiveScale = tempResponsiveScale;
		_positionElements(responsiveScale);


		stage.setDimensions({width: tempStageWidth, height: tempStageHeight}).renderAll();

		return svg;

	};

	/**
	 * Returns the views as SVG.
	 *
	 * @method getViewsSVG
	 * @return {array} An array with all views as SVG.
	 */
	FancyProductDesigner.prototype.getViewsSVG = function() {

		thisClass.deselectElement();
		thisClass.resetZoom();

		var SVGs = [],
			tempStageWidth = stage.getWidth(),
			tempStageHeight = stage.getHeight(),
			tempResponsiveScale = responsiveScale;

		stage.setDimensions({width:options.width, height: options.stageHeight});

		responsiveScale = 1;
		var objects = _positionElements(1);

		for(var i=0; i < viewsLength; ++i) {

			for(var j=0; j<objects.length; ++j) {
				var object = objects[j];
				object.visible = object.viewIndex == i;

				if(object.type == 'path-group') {
					object.left = (object.params.x * 1) - object.getWidth() * 0.5;
					object.top = (object.params.y * 1) - object.getHeight() * 0.5;
					object.setCoords();
				}
			}

			var svg = stage.toSVG(),
				$svg = $(svg);

			$svg.children('rect').remove(); //remove bounding boxes
			$svg.children('g').children('[style*="visibility: hidden"]').parent('g').remove(); //remove hidden elements
			svg = $('<div>').append($svg.clone()).html().replace(/(?:\r\n|\r|\n)/g, '');

			SVGs.push(svg);

		}

		//hide elements again that are not in the current view index
		for(var i=0; i<objects.length; ++i) {
			var object = objects[i];
			object.visible = object.viewIndex == currentViewIndex;

			if(object.type == 'path-group') {
				object.left = (object.params.x * responsiveScale);
				object.top = (object.params.y * responsiveScale);
				object.setCoords();
			}
		}

		responsiveScale = tempResponsiveScale;
		_positionElements(responsiveScale)
		stage.setDimensions({width: tempStageWidth, height: tempStageHeight}).renderAll();

		return SVGs;

	};

	/**
	 * Returns all views in one data URL. The different views will be positioned below each other.
	 *
	 * @method getProductDataURL
	 * @param {string} [format=png] The image format for the data URL. Allowed values 'png' and 'jpeg'.
	 * @param {string} [backgroundColor=transparent] The background color as hexadecimal value. For 'png' you can also use 'transparent'.
	 * @param {number} [multiplier=1] Multiplier to scale by.
	 * @return {string} One data URL string with all views.
	 */
	FancyProductDesigner.prototype.getProductDataURL = function(format, backgroundColor, multiplier) {

		format = typeof format !== 'undefined' ? format : 'png';
		backgroundColor = typeof backgroundColor !== 'undefined' ? backgroundColor : 'transparent';
		multiplier = typeof multiplier !== 'undefined' ? multiplier : 1;

		thisClass.deselectElement();
		thisClass.resetZoom();
		thisClass.selectView(0);

		var dataUrl,
			tempStageWidth = stage.getWidth(),
			tempStageHeight = stage.getHeight(),
			tempResponsiveScale = responsiveScale;

		stage.setBackgroundColor(backgroundColor, function() {

			//increase stage height and reposition objects
			stage.setDimensions({width: options.width, height: options.stageHeight * viewsLength});

			responsiveScale = 1;
			var objects = _positionElements(1);
			for(var i=0; i<objects.length; ++i) {
				var object = objects[i],
					topOffset = object.viewIndex * options.stageHeight;

				object.visible = true;
				object.top = object.top + topOffset;
				if(object.clippingRect !== undefined) {
					object.clippingRect.top = object.clippingRect.top + topOffset;
				}
			}

			//get data url
			try {
				dataUrl = stage.toDataURL({format: format, multiplier: multiplier});
			}
			catch(evt) {
				thisClass.showModal("Error: Please be sure that the images are hosted under the same domain and protocol, in which you are using the product designer!");
			}

			//set stage height to default
			for(var i=0; i<objects.length; ++i) {
				var object = objects[i],
					topOffset = object.viewIndex * options.stageHeight;

				object.visible = object.viewIndex == 0;
				object.top = object.top - topOffset;
				if(object.clippingRect !== undefined) {
					object.clippingRect.top = object.clippingRect.top - topOffset;
				}
			}

			responsiveScale = tempResponsiveScale;
			_positionElements(responsiveScale);
			stage.setDimensions({width: tempStageWidth, height: tempStageHeight}).setBackgroundColor('transparent').renderAll();

		});

		return dataUrl;

	};

	/**
	 * Returns the number of visible products in the context dialog.
	 *
	 * @method getProductsLength
	 * @return {number} The number of visible products.
	 */
	FancyProductDesigner.prototype.getProductsLength = function() {

		return $contextDialog.find('.fpd-content-products .fpd-item').size();

	};

	/**
	 * Returns the current visible view. A view contains a title, thumbnail and elements property.
	 *
	 * @method getView
	 * @return {object} An object containing title, thumbail and elements.
	 */
	FancyProductDesigner.prototype.getView = function() {

		return currentViews[currentViewIndex];

	};

	/**
	 * Returns the current visible view as data URL.
	 *
	 * @method getViewDataURL
	 * @param {string} [format=png] The image format for the data URL. Allowed values 'png' and 'jpeg'.
	 * @param {string} [backgroundColor=transparent] The background color as hexadecimal value. For 'png' you can also use 'transparent'.
	 * @param {number} [multiplier=1] Multiplier to scale by.
	 * @return {string} The current visible as data URL string.
	 */
	FancyProductDesigner.prototype.getViewDataURL = function(format, backgroundColor, multiplier) {

		format = typeof format !== 'undefined' ? format : 'png';
		backgroundColor = typeof backgroundColor !== 'undefined' ? backgroundColor : 'transparent';
		multiplier = typeof multiplier !== 'undefined' ? multiplier : 1;

		thisClass.deselectElement();
		thisClass.resetZoom();

		var dataURL = '',
			tempStageWidth = stage.getWidth(),
			tempStageHeight = stage.getHeight(),
			tempResponsiveScale = responsiveScale;

		stage.setDimensions({width: options.width, height:options.stageHeight}).setBackgroundColor(backgroundColor, function() {

			responsiveScale = 1;
			_positionElements(1);

			try {
				dataURL = stage.toDataURL({format: format, multiplier: multiplier});
			}
			catch(evt) {
				thisClass.showModal("Error: Please be sure that the images are hosted under the same domain and protocol, in which you are using the product designer!");
				return false;
			}

			responsiveScale = tempResponsiveScale;
			_positionElements(responsiveScale);
			stage.setDimensions({width: tempStageWidth, height: tempStageHeight}).setBackgroundColor('transparent').renderAll();

		});

		if(dataURL.length) {
			return dataURL;
		}
		else {
			return false;
		}


	};

	/**
	 * Returns the current selected view index. 0 is the first view index.
	 *
	 * @method getViewIndex
	 * @return {number} A number pointing to the current view index.
	 */
	FancyProductDesigner.prototype.getViewIndex = function() {

		return currentViewIndex;

	};

	/**
	 * Returns the fabric canvas used in the product designer.
	 *
	 * @method getStage
	 * @return {object} The fabric canvas.
	 */
	FancyProductDesigner.prototype.getStage = function() {

		return stage;

	};

	/**
	 * Returns an array with all custom added elements.
	 *
	 * @method getCustomElements
	 * @return {array} An array with objects with the fabric object and the parameters.
	 */
	FancyProductDesigner.prototype.getCustomElements = function() {

		var objects = stage.getObjects(),
			customElements = [];

		for(var i=0; i< objects.length; ++i) {
			var object = objects[i];
			if(object.params && object.params.isCustom) {
				customElements.push({element: object, parameters: object.params});
			}

		}

		return customElements;

	};

	/**
	 * Returns the scale value calculated with the passed image dimensions and the defined "resize-to" dimensions.
	 *
	 * @method getScalingByDimesions
	 * @param {number} imgW The width of the image.
	 * @param {number} imgH The height of the image.
	 * @param {number} resizeToW The maximum width for the image.
	 * @param {number} resizeToH The maximum height for the image.
	 * @return {number} The scale value to resize an image to a desired dimension.
	 */
	FancyProductDesigner.prototype.getScalingByDimesions = function(imgW, imgH, resizeToW, resizeToH) {

		var scaling = 1;
		if(imgW > imgH) {
			if(imgW > resizeToW) { scaling = resizeToW / imgW; }
			if(scaling * imgH > resizeToH) { scaling = resizeToH / imgH; }
		}
		else {
			if(imgH > resizeToH) { scaling = resizeToH / imgH; }
			if(scaling * imgW > resizeToW) { scaling = resizeToW / imgW; }
		}

		return scaling;

	};

	/**
	 * Returns the scale value calculated with the passed image dimensions and the defined "resize-to" dimensions.
	 *
	 * @method getViewsOptions
	 * @return {number} The scale value to resize an image to a desired dimension.
	 */
	FancyProductDesigner.prototype.getViewsOptions = function() {

		var optionsArray = [];
		for(var i=0; i < currentViews.length; ++i) {
			optionsArray.push(currentViews[i].options ? currentViews[i].options : {});
		}

		return optionsArray;

	};

	/**
	 * Adds a new product to the product designer.
	 *
	 * @method addProduct
	 * @param {array} views An array containing the views for a product. A view is an object with a title, thumbnail and elements property. The elements property is an array containing one or more objects with source, title, parameters and type.
	 * @param {string} [category] If categories are used, you need to define the category title.
	 */
	FancyProductDesigner.prototype.addProduct = function(views, category) {

		//categories are not used
		if($productCategories === null || $productCategories === false) {
			_addGridProduct(views);
		}
		//categories are used
		else {
			category = typeof category == 'undefined' ? $productCategories.val() : category;

			//check if category exists, otherwise create one
			if(productCategories[category] == undefined) {
				productCategories[category] = new Array();
				$productCategories.append('<option value="'+category+'">'+category+'</option>');
			}

			//push product in category object
			productCategories[category].push(views);

			//add product to grid if category is the same like the current showing one
			if($productCategories.val() == category) {
				_addGridProduct(views);
			}
		}

	};

	/**
	 * Loads a new product to the product designer.
	 *
	 * @method loadProduct
	 * @param {array} views An array containing the views for the product.
	 * @param {Boolean} [onlyReplaceInitialElements=false] If true, the initial elements will be replaced. Custom added elements will stay on the canvas.
	 */
	FancyProductDesigner.prototype.loadProduct = function(views, replaceInitialElements) {

		replaceInitialElements = typeof replaceInitialElements !== 'undefined' ? replaceInitialElements : false;

		if($fullLoader.is(':visible')) {
			return false;
		}
		productCreated = false;
		$contextDialog.addClass('fpd-hidden');

		if(replaceInitialElements) {

			nonInitials = new Array();
			var objects = stage.getObjects();
			for(var i=0; i < objects.length; ++i) {
				var obj = objects[i];
				if(obj.type != 'rect' && !obj.params.isInitial) {
					var elementObj = {
						type: obj.type == 'i-text' ? 'text' : 'image',
						source: obj.source,
						title: obj.title,
						parameters: obj.params
					};
					nonInitials[obj.viewIndex] == undefined ? nonInitials[obj.viewIndex] = new Array(elementObj) : nonInitials[obj.viewIndex].push(elementObj);
				}
			}

		}

		thisClass.clear();
		currentViews = views;

		var viewSelectionHtml = '<div class="fpd-views-selection fpd-grid-contain fpd-clearfix fpd-'+options.viewSelectionPosition+' '+(options.viewSelectionFloated ? 'fpd-float-items' : '')+'"></div>';

		if(options.viewSelectionPosition == 'outside') {
			$elem.after(viewSelectionHtml);
		}
		else {
			$productStage.append(viewSelectionHtml);
		}

		$elem.on('viewCreate', _onViewCreated);

		function _onViewCreated() {
			//add all views of product till views end is reached
			if(viewsLength < currentViews.length) {
				thisClass.addView(currentViews[viewsLength]);
			}
			//all views added
			else {

				$elem.off('viewCreate', _onViewCreated);

				/**
			     * Gets fired as soon as a product has been fully added to the designer.
			     *
			     * @event FancyProductDesigner#productCreate
			     * @param {Event} event
			     * @param {array} currentViews - An array containing all views of the product.
			     */
				$elem.trigger('productCreate', [currentViews]);

				//search for object with auto-select
				var objects = stage.getObjects();
				for(var i=0; i < objects.length; ++i) {
					var obj = objects[i];
					 if(obj.viewIndex == currentViewIndex && obj.params && obj.params.autoSelect) {
						 stage.setActiveObject(obj);
						 obj.setCoords();
					 }
				}

				productCreated = true;
				$contextDialog.removeClass('fpd-hidden');
			}

		};

		thisClass.addView(currentViews[0]);
		thisClass.selectView(0);

	};

	/**
	 * Selects a product from the current visible products in the context dialog.
	 *
	 * @method selectProduct
	 * @param {number} index The requested product by an index value. 0 will load the first product.
	 */
	FancyProductDesigner.prototype.selectProduct = function(index) {
		if(index == currentProductIndex) {	return false; }

		currentProductIndex = index;
		if(index < 0) { currentProductIndex = 0; }
		else if(index > thisClass.getProductsLength()-1) { currentProductIndex = thisClass.getProductsLength()-1; }

		var views = $contextDialog.find('.fpd-content-products .fpd-item').eq(currentProductIndex).data('views');
		thisClass.loadProduct(views, options.replaceInitialElements);

	};

	/**
	 * Selects a view from the current visible views.
	 *
	 * @method selectView
	 * @param {number} index The requested view by an index value. 0 will load the first view.
	 */
	FancyProductDesigner.prototype.selectView = function(index) {

		currentViewIndex = index;
		if(index < 0) { currentViewIndex = 0; }
		else if(index > $viewSelection.children().size()-1) { currentViewIndex = $viewSelection.children().size()-1; }

		thisClass.closeDialog();
		$viewSelection.children('div').removeClass('fpd-view-active')
		.eq(index).addClass('fpd-view-active');

		thisClass.deselectElement();

		var $layersList = $contextDialog.find('.fpd-content-layers .fpd-list').empty();

		var objects = stage.getObjects();
		for(var i=0; i < objects.length; ++i) {
			var object = objects[i];
			//show element if its in the current view
			object.visible = object.viewIndex == currentViewIndex;
			//append a layer list item
			if(object.viewIndex == currentViewIndex && object.isEditable) {
				_appendLayerItem(object.id, object.params.text == null ? object.title : object.params.text, object.params.zChangeable, object.params.removable, object.params.uploadZone, !object.evented);
			}
		}
		stage.renderAll();

		_updateViewOptions(currentViews[currentViewIndex].options);

	};

	/**
	 * Removes a product from the current visible products in the context dialog.
	 *
	 * @method removeProduct
	 * @param {number} index The product to be removed by an index value. 0 will remove the first product.
	 */
	FancyProductDesigner.prototype.removeProduct = function(index) {

		if(index < 0) { index = 0; }
		else if(index > thisClass.getProductsLength()-1) { index = thisClass.getProductsLength()-1; }

		$contextDialog.find('.fpd-content-products .fpd-grid > .fpd-item').eq(index).remove();

		//if product is showing on stage, clear stage
		if(index == currentProductIndex) {
			thisClass.clear();
			currentProductIndex = -1;
		}

	};

	/**
	 * Adds a view to the current visible product.
	 *
	 * @method addView
	 * @param {object} view An object with title, thumbnail and elements properties.
	 */
	FancyProductDesigner.prototype.addView = function(view) {

		viewsLength++;

		$viewSelection = $('.fpd-views-selection');

		$viewSelection.append('<div class="fpd-shadow-1 fpd-item fpd-tooltip" title="'+view.title+'"><picture style="background-image: url('+view.thumbnail+');"></picture></div>')
		.children('div:last').click(function(evt) {

			evt.preventDefault();
			thisClass.selectView($viewSelection.children('div').index($(this)));

		});

		var initialsView = $.merge([], view.elements), //copy
			nonInitialsView = nonInitials[viewsLength-1] ? nonInitials[viewsLength-1] : new Array(), //get non-initial elements
			viewElements = $.merge(([], initialsView), nonInitialsView); //append non-initials to initial elements

		_createSingleView(view.title, viewElements);
		_updateTooltip();

		viewsLength > 1 ? $viewSelection.show() : $viewSelection.hide();

	};

	/**
	 * Adds a new element to the product stage.
	 *
	 * @method addElement
	 * @param {string} type The type of an element you would like to add, 'image' or 'text'.
	 * @param {string} source For image the URL to the image and for text elements the default text.
	 * @param {string} title Only required for image elements.
	 * @param {object} [parameters] An object with the parameters, you would like to apply on the element.
	 * @param {number} [viewIndex] The index of the view where the element needs to be added to. If no index is set, it will be added to current showing view.
	 */
	FancyProductDesigner.prototype.addElement = function(type, source, title, params, viewIndex) {

		params = typeof params !== 'undefined' ? params : {}; //todo: change to parameters
		viewIndex = typeof viewIndex !== 'undefined' ? viewIndex : currentViewIndex;

		thisClass.deselectElement();

		if(typeof params != "object") {
			thisClass.showModal("The element "+title+" does not have a valid JSON object as parameters! Please check the syntax, maybe you set quotes wrong.");
			return false;
		}

		//merge default options
		if(type == 'text' || type == 'i-text' || type == 'curvedText') {
			params = $.extend({}, options.elementParameters, options.textParameters, params);
		}
		else {
			params = $.extend({}, options.elementParameters, options.imageParameters, params);
		}

		params.source = source;

		var pushTargetObject = false,
			targetObject = null;

		//store current color and convert colors in string to array
		if(params.colors && typeof params.colors == 'string') {
			//check if string contains hex color values
			if(params.colors.indexOf('#') == 0) {
				//convert string into array
				var colors = params.colors.replace(/\s+/g, '').split(',');
				params.colors = colors;
			}
			else if(viewsLength > 1) {
				//get all layers from first view
				var objects = stage.getObjects();
				for(var i=0; i < objects.length; ++i) {
					var object = objects[i];
					if(object.viewIndex == 0) {
						//look for the target object where to get the color from
						if(params.colors == object.title && targetObject == null) {
							targetObject = object;
							//push all objects in array that should have a color control from the target object
							pushTargetObject = true;
						}
					}
				}
			}
		}

		if(type == 'text' || type == 'i-text' || type == 'curvedText') {
			var defaultTextColor = params.colors[0] ? params.colors[0] : '#000000';
			params.currentColor = params.currentColor ? params.currentColor : defaultTextColor;
		}

		var fabricParams = {
			source: source,
			title: title,
			id: String(new Date().getTime()),
			visible: viewIndex == currentViewIndex,
			viewIndex: viewIndex,
			lockUniScaling: true
		};

		if(options.editorMode) {
			params.removable = params.resizable = params.rotatable = params.zChangeable = true;
		}
		else {
			$.extend(fabricParams, {
				selectable: false,
				lockRotation: true,
				lockScalingX: true,
				lockScalingY: true,
				lockMovementX: true,
				lockMovementY: true,
				hasControls: false,
				evented: false
			});
		}

		if(type == 'image' || type == 'path') {

			$fullLoader.show();

			var _fabricImageLoaded = function(fabricImage, params) {

				var w = fabricImage.width * params.scale,
					h = fabricImage.height * params.scale;


				$.extend(fabricParams, {params: params, originParams: $.extend({}, params), crossOrigin: "anonymous"});
				fabricImage.set(fabricParams);

				//color control for images
				if(pushTargetObject) {
					if(targetObject.colorControlFor) {
						targetObject.colorControlFor.push(fabricImage);
					}
					else {
						targetObject.colorControlFor = [];
						targetObject.colorControlFor.push(fabricImage);
					}
				}

				stage.add(fabricImage);
				$fullLoader.hide();
				thisClass.setElementParameters(fabricImage, fabricImage.params);

				/**
			     * Gets fired as soon as an element has beed added.
			     *
			     * @event FancyProductDesigner#elementAdded
			     * @param {Event} event
			     * @param {fabric.Object} object - The fabric object.
			     */
				$elem.trigger('elementAdded', [fabricImage]);

			};

			var imageParts = source.split('.');
			//load svg from url
			if($.inArray('svg', imageParts) != -1) {
				fabric.loadSVGFromURL(source, function(objects, options) {
					var svgGroup = fabric.util.groupSVGElements(objects, options);
					if(!params.currentColor) {
						params.colors = [];
						for(var i=0; i < objects.length; ++i) {
							var color = tinycolor(objects[i].fill);
							params.colors.push(color.toHexString());
						}
						params.currentColor = params.colors;
					}
					_fabricImageLoaded(svgGroup, params);
				});
			}
			//load png/jpeg from url
			else {
				new fabric.Image.fromURL(source, function(fabricImg) {
					_fabricImageLoaded(fabricImg, params);
				});
			}

		}
		else if(type == 'text' || type == 'i-text' || type == 'curvedText') {

			params.text = params.text ? params.text : params.source;
			params.font = params.font ? params.font : options.fonts[0];
			if(params.font == undefined) {
				params.font = 'Arial';
			}

			$.extend(fabricParams, {
				fontSize: params.textSize,
				fontFamily: params.font,
				fontStyle: params.fontStyle,
				fontWeight: params.fontWeight,
				textAlign: params.textAlign,
				textBackgroundColor: params.textBackgroundColor,
				lineHeight: params.lineHeight,
				textDecoration: params.textDecoration,
				fill: params.currentColor,
				editable: params.editable,
				spacing: params.curveSpacing,
				radius: params.curveRadius,
				reverse: params.curveReverse,
				params: params,
				originParams: $.extend({}, params)
			});

			//make text curved
			if(params.curved) {
				var fabricText = new fabric.CurvedText(params.text.replace(/\\n/g, '\n'), fabricParams);
			}
			//just interactive text
			else {
				var fabricText = new fabric.IText(params.text.replace(/\\n/g, '\n'), fabricParams);

			}

			stage.add(fabricText);
			thisClass.setElementParameters(fabricText, fabricText.params);

			//render font
			_renderOnFontLoaded(params.font);

			$elem.trigger('elementAdded', [fabricText]);
		}
		else {
			thisClass.showModal('Sorry. This type of element is not allowed!');
			return false;
		}

	};

	/**
	 * Adds a new design to the designs dialog.
	 *
	 * @method addDesign
	 * @param {string} source The URL of the image.
	 * @param {string} title The title for the design.
	 * @param {object} [parameters] An object with the parameters, you would like to apply on the design.
	 * @param {string} [category] If design categories are used, you need to set the category title where you would like to add the design to.
	 * @param {string} [thumbnail] The URL of the thumbnail, if you would like to use another thumbnail instead the actual design image.
	 */
	FancyProductDesigner.prototype.addDesign = function(source, title, parameters, category, thumbnail) {

		parameters = typeof parameters !== 'undefined' ? parameters : {};
		thumbnail = typeof thumbnail == 'undefined' ? source : thumbnail;

		//categories are not used
		if($designCategories === null || $designCategories === false) {
			_addGridDesign({source: source, title: title, parameters: parameters, thumbnail: thumbnail});
		}
		//categories are used
		else {
			category = typeof category == 'undefined' ? $designCategories.val() : category;

			//check if category exists, otherwise create one
			if(designCategories[category] == undefined) {
				designCategories[category] = new Array();
				$designCategories.append('<option value="'+category+'">'+category+'</option>');
			}

			//push design in category object
			designCategories[category].push({source: source, title: title, parameters: parameters, thumbnail: thumbnail});

			//add design to list if category is the same like the current showing one
			if($designCategories.val() == category) {
				_addGridDesign({source: source, title: title, parameters: parameters, thumbnail: thumbnail});
			}
		}

	};

	/**
	 * Adds a new custom image to the product stage. This method should be used if you are using an own image uploader for the product designer. The customImageParameters option will be applied on the images that are added via this method.
	 *
	 * @method addCustomImage
	 * @param {string} source The URL of the image.
	 * @param {string} title The title for the design.
	 */
	FancyProductDesigner.prototype.addCustomImage = function(source, title) {

		var $imageInput = $contextDialog.find('.fpd-input-image'),
			image = new Image;
    		image.src = source;

    	$fullLoader.show();

		image.onload = function() {

			var imageH = this.height,
				imageW = this.width,
				scaling = 1;

			if(imageW > viewOptions.customImageParameters.maxW ||
			imageW < viewOptions.customImageParameters.minW ||
			imageH > viewOptions.customImageParameters.maxH ||
			imageH < viewOptions.customImageParameters.minH) {
				$fullLoader.hide();
    			thisClass.showModal(options.labels.uploadedDesignSizeAlert);
    			return false;
			}

			var imageParams = viewOptions.customImageParameters;
			imageParams.scale = thisClass.getScalingByDimesions(imageW, imageH, viewOptions.customImageParameters.resizeToW, viewOptions.customImageParameters.resizeToH);
			imageParams.isCustom = true;

    		thisClass.addElement(
    			'image',
    			source,
    			title,
	    		imageParams
    		);

    		thisClass.addDesign(source, title, imageParams, options.labels.myUploadedImgCat);

		}

		image.onerror = function(evt) {
			thisClass.showModal('Image could not be loaded!');
		}

	};

	/**
	 * Opens the current showing product in a Pop-up window and shows the print dialog.
	 *
	 * @method print
	 */
	FancyProductDesigner.prototype.print = function() {

		var viewsDataURL = thisClass.getViewsDataURL(),
			images = new Array(),
			imageLoop = 0;

		//load all images first
		for(var i=0; i < viewsDataURL.length; ++i) {

			var image = new Image();
			image.src = viewsDataURL[i];
			image.onload = function() {

				images.push(this);
				imageLoop++;

				//add images to popup and print popup
				if(imageLoop == viewsDataURL.length) {

					var popup = window.open('','','width='+images[0].width+',height='+(images[0].height*viewsDataURL.length)+',location=no,menubar=no,scrollbars=yes,status=no,toolbar=no');
					_popupBlockerAlert(popup);

					popup.document.title = "Print Image";
					for(var j=0; j < images.length; ++j) {
						$(popup.document.body).append('<img src="'+images[j].src+'" />');
					}

					setTimeout(function() {
						popup.print();
					}, 1000);

				}
			}

		}

	};


	/**
	 * Creates an image of the current showing product.
	 *
	 * @method createImage
	 * @param {boolean} [openInBlankPage= true] Opens the image in a Pop-up window.
	 * @param {boolean} [forceDownload=false] Downloads the image to the user's computer.
	 */
	FancyProductDesigner.prototype.createImage = function(openInBlankPage, forceDownload) {

		if(typeof(openInBlankPage)==='undefined') openInBlankPage = true;
		if(typeof(forceDownload)==='undefined') forceDownload = false;

		var dataUrl = thisClass.getProductDataURL();
		var image = new Image();
		image.src = dataUrl;

		image.onload = function() {
			if(openInBlankPage) {

				var popup = window.open('','_blank');
				_popupBlockerAlert(popup);

				popup.document.title = "Product Image";
				$(popup.document.body).append('<img src="'+this.src+'" download="product.png" />');

				if(forceDownload) {
					window.location.href = popup.document.getElementsByTagName('img')[0].src.replace('image/png', 'image/octet-stream');
				}
			}

		}

		return image;

	};

	/**
	 * Clears the product stage and resets everything.
	 *
	 * @method clear
	 */
	FancyProductDesigner.prototype.clear = function() {

		thisClass.deselectElement();
		thisClass.resetZoom();
		if($viewSelection) { $viewSelection.remove(); }
		$contextDialog.hide().find('.fpd-content-layers .fpd-list').empty();
		stage.clear();
		viewsLength = currentViewIndex = currentPrice = 0;
		currentViews = currentElement = null;

		/**
	     * Gets fired as soon as the stage has been cleared.
	     *
	     * @event FancyProductDesigner#stageClear
	     * @param {Event} event
	     */
		$elem.trigger('stageClear');
		stageCleared = true;

	};

	/**
	 * Deselects the current selected element.
	 *
	 * @method deselectElement
	 * @param {boolean} [discardActiveObject=true] Discards the active element.
	 */
	FancyProductDesigner.prototype.deselectElement = function(discardActiveObject) {

		discardActiveObject = typeof discardActiveObject == 'undefined' ? true : discardActiveObject;

		_resetUndoRedo();

		$colorPicker.removeClass('fpd-colorpicker-group').empty();
		$elementTooltip.hide();

		if(currentBoundingObject) {
			currentBoundingObject.remove();
			currentBoundingObject = null;
		}

		if(discardActiveObject) {
			stage.discardActiveObject();
		}

		//hide dialog if edit element dialog is visible
		if($contextDialog.find('.fpd-content-edit').is(':visible')) {
			thisClass.closeDialog();
		}
		$contextDialog.find('.fpd-content-edit .fpd-list-row').addClass('fpd-hidden');

		currentElement = null;

		if($editorBox) {
			$editorBox.find('i').text('');
		}

		stage.renderAll().calcOffset();

	};

	/**
	 * Removes an element using the fabric object or the title of an element.
	 *
	 * @method removeElement
	 * @param {object|string} element Needs to be a fabric object or the title of an element.
	 */
	FancyProductDesigner.prototype.removeElement = function(element) {

		if(typeof element === 'string') {
			element = thisClass.getElementByTitle(element);
		}

		if(element.params.price != 0 && !element.params.uploadZone) {
			currentPrice -= element.params.price;
			$elem.trigger('priceChange', [element.params.price, currentPrice]);
		}

		$contextDialog.find('.fpd-content-layers .fpd-list').children('[id="'+element.id+'"]').remove();

		stage.remove(element);

		if(element.params.hasUploadZone) {

			//check if upload zone contains objects
			var objects = stage.getObjects(),
				uploadZoneEmpty = true;
			for(var i=0; i < objects.length; ++i) {
				var object = objects[i];
				if(object.visible && object.params.replace == element.params.replace) {
					uploadZoneEmpty = false;
					break;
				}
			}
			var uploadZoneObject = _getUploadZone(element.params.replace);

			uploadZoneObject.opacity = uploadZoneEmpty ? 1 : 0;
		}

		/**
	     * Gets fired as soon as an element has been removed.
	     *
	     * @event FancyProductDesigner#elementRemove
	     * @param {Event} event
	     * @param {fabric.Object} element - The fabric object that has been removed.
	     */
		$elem.trigger('elementRemove', [element]);
		thisClass.deselectElement();

	};

	/**
	 * Returns an fabric object by title.
	 *
	 * @method getElementByTitle
	 * @param {string} title The title of an element.
	 */
	FancyProductDesigner.prototype.getElementByTitle = function(title) {

		var objects = stage.getObjects();
		for(var i = 0; i < objects.length; ++i) {
			if(objects[i].title == title) {
				return objects[i];
				break;
			}
		}

	};

	/**
	 * Sets the zoom of the stage. 1 is equal to no zoom.
	 *
	 * @method setZoom
	 * @param {number} value The zoom value.
	 */
	FancyProductDesigner.prototype.setZoom = function(value) {

		thisClass.deselectElement();
		var point = new fabric.Point(stage.getWidth() * 0.5, stage.getHeight() * 0.5);
		stage.zoomToPoint(point, value);
		if(value == 1) {
			thisClass.resetZoom();
		}

	};

	/**
	 * Resets the zoom.
	 *
	 * @method resetZoom
	 */
	FancyProductDesigner.prototype.resetZoom = function() {

		thisClass.deselectElement();
		stage.zoomToPoint(new fabric.Point(0, 0), 1);
		stage.absolutePan(new fabric.Point(0, 0));

	};

	/**
	 * Sets the dimensions of the stage(canvas). todo: check
	 * @param {number} width The width for the stage.
	 * @param {number} height The height for the stage.
	 */
	FancyProductDesigner.prototype.setStageDimensions = function(width, height) {

		options.width = width;
		options.stageHeight = height;

		$elem.width(width);
		$productStage.height(height * responsiveScale);
		stage.setDimensions({width: $elem.width(), height: options.stageHeight * responsiveScale})
		.calcOffset().renderAll();

		_refreshDesignerSize();

	};

	/**
	 * Shows a message in the snackbar.
	 *
	 * @method showMessage
	 * @param {string} text The text for the message.
	 */
	FancyProductDesigner.prototype.showMessage = function(text) {

		var $snackbar;

		if($body.children('.fpd-snackbar-internal').size() > 0) {
			$snackbar = $body.children('.fpd-snackbar');
		}
		else {
			$snackbar = $body.append('<div class="fpd-snackbar-internal fpd-snackbar fpd-shadow-1"><p></p></div>').children('.fpd-snackbar-internal');
		}

		$snackbar.removeClass('fpd-show-up').children('p').html(text).parent().addClass('fpd-show-up');

		setTimeout(function() {
			$snackbar.removeClass('fpd-show-up');
		}, 3000);

	};

	/**
	 * Calls a specified content in the context dialog.
	 *
	 * @method callDialogContent
	 * @param {string} target An unique target name. Possible values: 'layers', 'adds', 'products', 'saved-products', 'edit'.
	 * @param {string} title The title for the context dialog, which appears in the head of the context dialog.
	 * @param {string} [subTarget] An unique sub-target name. The 'adds' dialog has following sub-dialogs: 'facebook', 'instagram', 'designs'.
	 * @param {boolean} [deselectElement] Deselects the current selected element.
	 */
	FancyProductDesigner.prototype.callDialogContent = function(target, title, subTarget, deselectElement) {

		subTarget = typeof subTarget !== 'undefined' ? subTarget : null;
		deselectElement = typeof deselectElement !== 'undefined' ? deselectElement : true;

		if(deselectElement) {
			thisClass.deselectElement();
		}

		//hide sub contents
		$contextDialog.find('.fpd-content-sub.fpd-show').removeClass('fpd-show');
		//hide content-back button
		$contextDialog.find('.fpd-content-back').removeClass('fpd-show');

		//get target div
		var $target = $contextDialog.find('.fpd-dialog-content .fpd-content-'+target);
		if($target.is(':hidden')) {
			$target.siblings('div').stop().hide()
			//show requested content div
			$target.stop().fadeIn(300);
		}

		$contextDialog.show();

		//lazy load for products
		if(target == 'products' && options.lazyLoad) {
			$currentLazyLoadContainer = $target;
			_refreshLazyLoad(false);
		}

		//update adds UI, necessary if different adds are used in an upload zone and view
		if(target === 'adds' && currentUploadZone === null) {
			_updateInterface(viewOptions);
		}

		if(subTarget) {

			var $subTarget = $contextDialog.find('.fpd-content-sub[data-subContext="'+subTarget+'"]').addClass('fpd-show');
			$contextDialog.find('.fpd-content-back').data('parentTitle', $contextDialog.find('.fpd-dialog-title').text())
			.addClass('fpd-show');

			//lazy load for designs
			$currentLazyLoadContainer = null;
			if(subTarget == 'designs' && options.lazyLoad) {
				$currentLazyLoadContainer = $subTarget;
				_refreshLazyLoad(false);
			}

		}

		_setDialogTitle(title);
		//_setContextDialogPosition();

	};

	/**
	 * Defines the current upload zone by using the title of a visible upload zone.
	 *
	 * @method setUploadZone
	 * @param {string} title The title of a visible upload zone.
	 */
	FancyProductDesigner.prototype.setUploadZone = function(title) {

		currentUploadZone = title;
		thisClass.closeDialog();

	};

	/**
	 * Closes the context dialog box
	 *
	 * @method closeDialog
	 */
	FancyProductDesigner.prototype.closeDialog = function() {

		$contextDialog.hide();
		$colorPicker.find('input').spectrum('hide');
		$currentLazyLoadContainer = null;
		currentUploadZone = null;

	};

	/**
	 * Defines a clipping rectangle for an element.
	 *
	 * @method setClippingRect
	 * @param {fabric.Object | string} element A fabric object or the title of an element.
	 * @param {object} clippingRect Ob object containg x, y, width and height values to define the rectangle.
	 * @example
	 * yourDesigner.setClippingRect("Element Title", {x: 100, y: 200, width: 300, height: 400});
	 * @version 3.0.2
	 */
	FancyProductDesigner.prototype.setClippingRect = function(element, clippingRect) {

		//if element is string, get by title
		if(typeof element == 'string') {
			element = thisClass.getElementByTitle(element);
		}

		element.clippingRect = clippingRect;
		stage.renderAll();

	};

	/**
	 * Opens the modal box with an own message.
	 *
	 * @method showModal
	 * @param {string} message The message you would like to display in the modal box.
	 * @version 3.0.7
	 */
	FancyProductDesigner.prototype.showModal = function(message) {

		var html = '<div class="fpd-modal-internal fpd-modal-overlay"><div class="fpd-modal-wrapper fpd-shadow-3"><div class="fpd-modal-content"></div><div class="fpd-modal-buttons"><span class="fpd-modal-submit fpd-secondary-bg-color fpd-secondary-text-color fpd-btn-raised fpd-btn">'+options.labels.modalSubmit+'</span></div></div></div>';

		if($('.fpd-modal-internal').size() === 0) {

			$body.append(html);
			$internalModal = $body.children('.fpd-modal-internal:first');

			$internalModal.find('.fpd-modal-submit').click(function(evt) {

				evt.preventDefault();
				$internalModal.fadeOut(200);

			});

		}

		$internalModal.fadeIn(300).find('.fpd-modal-content').html(message);

	};

	/**
	 * Sets the parameters for a specified element.
	 *
	 * @method setElementParameters
	 * @param {fabric.Object | string} element A fabric object or the title of an element.
	 * @param {object} parameters An object with the parameters that should be applied to the element.
	 */
	FancyProductDesigner.prototype.setElementParameters = function(element, parameters) {

		if(element === undefined || parameters === undefined) {
			return false;
		}

		//if element is string, get by title
		if(typeof element == 'string') {
			element = thisClass.getElementByTitle(element);
		}

		//store undos
		if(productCreated) {
			var oldParameters = {};
			for (var key in parameters) {
				oldParameters[key] = element.params[key];
			}
			undos.push({element: element, parameters: oldParameters});
		}

		//adds the element into a upload zone
		if(currentUploadZone && currentUploadZone != '') {

			parameters.z = -1;

			var uploadZoneObj = thisClass.getElementByTitle(currentUploadZone),
				bbRect = uploadZoneObj.getBoundingRect();

			$.extend(parameters, {
					boundingBox: currentUploadZone,
					scale: thisClass.getScalingByDimesions(element.getWidth(), element.getHeight(), (bbRect.width / responsiveScale)-1, (bbRect.height / responsiveScale)-1),
					autoCenter: true,
					removable: true,
					zChangeable: false,
					rotatable: uploadZoneObj.params.rotatable,
					draggable: uploadZoneObj.params.draggable,
					resizable: uploadZoneObj.params.resizable,
					price: uploadZoneObj.params.price,
					replace: currentUploadZone,
					hasUploadZone: true
				}
			);

			uploadZoneObj.opacity = 0;

		}

		//check if a upload zone contains an object
		var objects = stage.getObjects();
		for(var i=0; i < objects.length; ++i) {
			var object = objects[i];
			if(object.params && object.params.uploadZone && object.title == parameters.replace) {
				object.opacity = 0;
			}
		}

		//if topped, z-index can not be changed
		if(parameters.topped) {
			parameters.zChangeable = false;
		}

		//new element added
		if(	typeof parameters.colors === 'object' ||
			parameters.removable ||
			parameters.draggable ||
			parameters.resizable ||
			parameters.rotatable ||
			parameters.zChangeable ||
			parameters.editable ||
			parameters.patternable
			|| parameters.uploadZone) {

			element.isEditable = element.evented = true;
			element.set('selectable', true);


			if(element.viewIndex == currentViewIndex && $contextDialog.find('.fpd-content-layers .fpd-list-row[id="'+element.id+'"]').size() == 0) {
				_appendLayerItem(
					element.id,
					parameters.text == null ? element.title : parameters.text,
					parameters.zChangeable,
					parameters.removable,
					parameters.uploadZone,
					!element.evented
				);
			}

		}

		if(parameters.opacity !== undefined) {
			element.set('opacity', parameters.opacity);
			//needs to be called for curved text
			if(element.params.curved) {
				element.setFill(element.fill);
			}
		}

		//upload zones have no controls
		if(!parameters.uploadZone || options.editorMode) {

			if(parameters.draggable) {
				element.lockMovementX = element.lockMovementY = false;
			}

			if(parameters.rotatable) {
				element.lockRotation = false;
			}

			if(parameters.resizable) {
				element.lockScalingX = element.lockScalingY = false;
			}

			if((parameters.resizable || parameters.rotatable || parameters.removable)) {
				element.hasControls = true;
			}

		}

		if(parameters.originX) {
			element.setOriginX(parameters.originX);

		}

		if(parameters.originY) {
			element.setOriginY(parameters.originY);
		}

		if(parameters.x !== undefined) {
			element.set('left', parameters.x);
		}

		if(parameters.y !== undefined) {
			element.set('top', parameters.y);
		}

		if(parameters.scale !== undefined) {

			element.set('scaleX', parameters.scale);
			element.set('scaleY', parameters.scale);
		}

		if(parameters.degree !== undefined) {
			element.set('angle', parameters.degree);
		}

		//replace element
		if(parameters.replace && parameters.replace != '' && element.viewIndex === currentViewIndex) {
			var objects = stage.getObjects();
			for(var i = 0; i < objects.length; ++i) {
				var object = objects[i];
				if(object.params != undefined && object.clipFor == undefined && object.params.replace == parameters.replace && object.visible && element !== object) {
					parameters.z = _getZIndex(object);
					parameters.x = object.params.x;
					parameters.y = object.params.y;
					parameters.autoCenter = false;
					thisClass.removeElement(object);
					break;
				}
			}
		}

		//center element
		if(parameters.autoCenter) {
			_doCentering(element);
		}

		if(parameters.flipX !== undefined) {
			element.set('flipX', parameters.flipX);
		}

		if(parameters.flipY !== undefined) {
			element.set('flipY', parameters.flipY);
		}

		if(parameters.price && !parameters.uploadZone) {
			currentPrice += parameters.price;

			/**
		     * Gets fired as soon as the price has changed.
		     *
		     * @event FancyProductDesigner#priceChange
		     * @param {Event} event
		     * @param {number} elementPrice - The price of the element.
		     * @param {number} totalPrice - The total price.
		     */
			$elem.trigger('priceChange', [parameters.price, currentPrice]);
		}

		//change element color
		if(parameters.currentColor !== undefined && parameters.pattern == null) {
			_changeColor(element, parameters.currentColor);
		}

		//set pattern

		if(parameters.pattern !== undefined) {
			_setPattern(element, parameters.pattern);
		}

		//set filter
		if(parameters.filter) {
			element.filters = [];
			var fabricFilter = _getFabircFilter(parameters.filter);
			if(fabricFilter != null) {
				element.filters.push(fabricFilter);
			}
			element.applyFilters(function() {
				stage.renderAll();
				$body.mouseup();
			});
		}

		//clip element
		if((parameters.boundingBox && parameters.boundingBoxClipping) || parameters.hasUploadZone) {
			_clipElement(element);
		}

		//set z position
		if(parameters.z >= 0) {
			_setZIndex(element, parameters.z);
		}

		if(parameters.text) {
			var text = parameters.text;
			if(element.params.maxLength != 0 && text.length > element.params.maxLength) {
				text = text.substr(0, element.params.maxLength);
				element.selectionStart = element.params.maxLength;
			}

			parameters.text = text;
			element.setText(text);
		}

		if(parameters.font !== undefined) {
			element.setFontFamily(parameters.font);
			_renderOnFontLoaded(parameters.font);
		}

		if(parameters.lineHeight !== undefined) {
			element.set('lineHeight', parameters.lineHeight);
		}

		if(parameters.textAlign !== undefined) {
			element.set('textAlign', parameters.textAlign);
		}

		if(parameters.fontWeight !== undefined) {
			element.set('fontWeight', parameters.fontWeight);
		}

		if(parameters.fontStyle !== undefined) {
			element.set('fontStyle', parameters.fontStyle);
		}

		if(parameters.textDecoration !== undefined) {
			element.set('textDecoration', parameters.textDecoration);
		}

		if(element.params.curved) {

			if(parameters.curveRadius) {
				element.set('radius', parameters.curveRadius);
			}

			if(parameters.curveSpacing) {
				element.set('spacing', parameters.curveSpacing);
			}

			if(parameters.curveReverse !== undefined) {
				element.set('reverse', parameters.curveReverse);
			}

		}

		//select element
		if(parameters.autoSelect && element.isEditable && element.viewIndex == currentViewIndex) {
			stage.setActiveObject(element);
			element.setCoords();
		}

		//check for other topped elements
		_bringToppedElementsToFront();

		//bring element to front
		if(parameters.topped) {
			element.bringToFront();
		}

		for (var key in parameters) {
			element.params[key] = parameters[key];
		}

		element.setCoords();
		stage.renderAll().calcOffset();

		_updateEditUI();
		_checkContainment(element);
		_updateEditorBox(element);
		_refreshDesignerSize();

	};

};

/**
 * Check out the official <a href="http://jquery.com" target="_blank">jQuery website</a> for more information.
 * @module jQuery.fn
*/

;(function($) {

	"use strict";

	/**
	 * Creates the product designer from a HTML element.
	 *
	 * @class jQuery.fn.fancyProductDesigner
	 * @constructor
	 * @param {Object} options See <a href="./jQuery.fn.fancyProductDesigner.defaults.html">jQuery.fn.fancyProductDesigner.defaults</a>
	 * @return {(jQuery | FancyProductDesigner)} An object of jQuery or when adding .data('fpd') to the call an instance of <a href="./FancyProductDesigner.html">FancyProductDesigner</a> that allows to use the API.
	 * @example
	 * var fpd = $('#fpd').fancyProductDesigner({width: 1200, stageHeight: 800}).data('fpd');
	 * fpd.getProduct();
	*/
	jQuery.fn.fancyProductDesigner = function( options ) {

		return this.each(function() {

			var element = $(this);

            // Return early if this element already has a plugin instance
            if (element.data('fancy-product-designer')) { return };

            var fpd = new FancyProductDesigner(this, options);

            // Store plugin object in this element's data
            element.data('fancy-product-designer', fpd);

		});
	};

	/**
	* The defaults option.
	*
	* @property jQuery.fn.fancyProductDesigner.defaults
	* @for jQuery.fn.fancyProductDesigner
	* @type {Object}
	*/
	$.fn.fancyProductDesigner.defaults = {
		/**
		* The width for the product designer.
		*
		* @property width
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Number}
		* @default "900"
		*/
		width: 900,
		/**
		* The stage height for the product designer.
		*
		* @property stageHeight
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Number}
		* @default "600"
		*/
		stageHeight: 600,
		/**
		* Enables the UI element to download the product as image.
		*
		* @property imageDownloadable
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Boolean}
		* @default true
		*/
		imageDownloadable: true,
		/**
		* Enables the UI element to save the product as PDF.
		*
		* @property saveAsPdf
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Boolean}
		* @default true
		*/
		saveAsPdf: true,
		/**
		* Enables the UI element to print the product.
		*
		* @property printable
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Boolean}
		* @default true
		*/
		printable: true,
		/**
		* Allows to save a product in the user's browser storage.
		*
		* @property allowProductSaving
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Boolean}
		* @default true
		*/
		allowProductSaving: true,
		/**
		* Enables the tooltips.
		*
		* @property tooltips
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Boolean}
		* @default true
		*/
		tooltips: true,
		/**
		* Enables the editor mode, which will add a helper box underneath the product designer with some options of the current selected element.
		*
		* @property editorMode
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Boolean}
		* @default false
		*/
		editorMode: false,
		/**
		* Sets the position of the view selection. Possible values: tl,tr,br,bl,outside.
		*
		* @property viewSelectionPosition
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default 'tr'
		*/
		viewSelectionPosition: 'tr',
		/**
		* If true the view selection items will be aligned in one line.
		*
		* @property viewSelectionFloated
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Boolean}
		* @default false
		*/
		viewSelectionFloated: false,
		/**
		* An array containing all available fonts.
		*
		* @property fonts
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Aarray}
		* @default ['Arial', 'Helvetica', 'Times New Roman', 'Verdana', 'Geneva']
		*/
		fonts: ['Arial', 'Helvetica', 'Times New Roman', 'Verdana', 'Geneva'],
		/**
		* The directory path that contains the templates.
		*
		* @property templatesDirectory
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default 'templates/'
		*/
		templatesDirectory: 'templates/',
		/**
		* The path to the directory that contains php scripts that are used for some functions of the plugin.
		*
		* @property phpDirectory
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default 'php/'
		*/
		phpDirectory: 'php/',
		/**
		* An array with image URLs that are used for text patterns.
		*
		* @property patterns
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default []
		*/
		patterns: [],
		/**
		* To add photos from Facebook, you have to set your own Facebook API key.
		*
		* @property facebookAppId
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default ''
		*/
		facebookAppId: '',
		/**
		* To add photos from Instagram, you have to set an <a href="http://instagram.com/developer/" target="_blank">Instagram client ID</a>.
		*
		* @property instagramClientId
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default ''
		*/
		instagramClientId: '', //the instagram client ID -
		/**
		* This URI to the php/instagram-auth.php. You have to update this option if you are using a different folder structure.
		*
		* @property instagramRedirectUri
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default ''
		*/
		instagramRedirectUri: '',
		/**
		* The zoom step when using the UI slider to change the zoom level.
		*
		* @property zoomStep
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Number}
		* @default 0.2
		*/
		zoomStep: 0.2,
		/**
		* The maximal zoom factor. Set it to 1 to hide the zoom feature in the user interface.
		*
		* @property maxZoom
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Number}
		* @default 3
		*/
		maxZoom: 3,
		/**
		* Set custom names for your hexdecimal colors. key=hexcode without #, value: name of the color.
		*
		* @property hexNames
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Object}
		* @default {}
		* @example hexNames: {000000: 'dark',ffffff: 'white'}
		*/
		hexNames: {},
		/**
		* The border color of the selected element.
		*
		* @property selectedColor
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default '#d5d5d5'
		*/
		selectedColor: '#d5d5d5',
		/**
		* The border color of the bounding box.
		*
		* @property boundingBoxColor
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default '#005ede'
		*/
		boundingBoxColor: '#005ede',
		/**
		* The border color of the element when its outside of his bounding box.
		*
		* @property outOfBoundaryColor
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default '#990000'
		*/
		outOfBoundaryColor: '#990000',
		/**
		* The padding for the controls that are around an element.
		*
		* @property paddingControl
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Number}
		* @default 10
		*/
		paddingControl: 10,
		/**
		* If true only the initial elements will be replaced when changing the product. Custom added elements will not be removed.
		*
		* @property replaceInitialElements
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Boolean}
		* @default false
		*/
		replaceInitialElements: false,
		/**
		* If true lazy load will be used for the images in the "Designs" module and "Change Product" module.
		*
		* @property lazyLoad
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Boolean}
		* @default true
		*/
		lazyLoad: true,
		/**
		* Sets the positioning of the dialog box. Possible values: 'dynamic', 'left' or 'right'.
		*
		* @property dialogBoxPositioning
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {String}
		* @default 'dynamic'
		*/
		dialogBoxPositioning: 'dynamic',
		/**
		* An object that contains the settings for the AJAX post when a photo from a social network (Facebook, Instagram) is selected. This allows to send the URL of the photo to a custom-built script. By default the URL is send to php/get_image_data_url.php, which returns the data URI of the photo. See the <a href="http://api.jquery.com/jquery.ajax/" target="_blank">official jQuery.ajax documentation</a> for more information. The data object has a reserved property called url, which is the image URL that will send to the script. The success function is also reserved.
		*
		* @property socialPhotoAjaxSettings
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Object}
		* @default {}
		*/
		socialPhotoAjaxSettings: {
			url: 'php/get_image_data_url.php',
			method: 'POST',
			dataType: 'json',
			data: {}
		},
		/**
		* An object containing the default element parameters. See <a href="./jQuery.fn.fancyProductDesigner.defaults.elementParameters.html">jQuery.fn.fancyProductDesigner.defaults.elementParameters</a>.
		*
		* @property elementParameters
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Object}
		*/
		elementParameters: {
			/**
			* The x-position.
			*
			* @property x
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default 0
			*/
			x: 0,
			/**
			* The y-position.
			*
			* @property y
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default 0
			*/
			y: 0,
			/**
			* Allows to set the z-index of an element, -1 means it will be added on the stack of layers
			*
			* @property z
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default -1
			*/
			z: -1,
			/**
			* A value between 0 and 1 to set the opacity.
			*
			* @property opacity
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default 1
			*/
			opacity: 1,
			/**
			* The reference point for the x-axis. Possible values: 'left' or 'center'.
			*
			* @property originX
			* @type {String}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default 'center'
			*/
			originX: 'center',
			/**
			* The reference point for y-axis. Possible values: 'left' or 'center'.
			*
			* @property originY
			* @type {String}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default 'center'
			*/
			originY: 'center',
			/**
			* A value between 0 or bigger to re-scale the element.
			*
			* @property scale
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default 1
			*/
			scale: 1,
			/**
			* A value between 0 and 360 to set a degree for the element.
			*
			* @property degree
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default 0
			*/
			degree: 0,
			/**
			* The price for the element.
			*
			* @property price
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default 0
			*/
			price: 0, //how much does the element cost
			/**
			* <ul><li>If false, no colorization for the element is possible.</li><li>One hexadecimal color will enable the colorpicker</li><li>Mulitple hexadecimal colors separated by commmas will show a range of colors the user can choose from.</li></ul>
			*
			* @property colors
			* @type {Boolean | String}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			* @example colors: "#000000" => Colorpicker, colors: "#000000,#ffffff" => Range of colors
			*/
			colors: false,
			/**
			* A hexadecimal color value defining the default color for the element.
			*
			* @property currentColor
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			currentColor: false,
			/**
			* If true the user can remove the element.
			*
			* @property removable
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			removable: false,
			/**
			* If true the user can drag the element.
			*
			* @property draggable
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			draggable: false,
			/**
			* If true the user can rotate the element.
			*
			* @property rotatable
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			rotatable: false,
			/**
			* If true the user can resize the element.
			*
			* @property resizable
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			resizable: false,
			/**
			* If true the user can change the z-position the element.
			*
			* @property zChangeable
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			zChangeable: false,
			/**
			* Defines a bounding box (printing area) for the element.<ul>If false no bounding box</li><li>The title of an element in the same view, then the boundary of the target element will be used as bounding box.</li><li>An object with x,y,width and height defines the bounding box</li></ul>
			*
			* @property boundingBox
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			boundingBox: false,
			/**
			* Centers the element in the canvas or when it has a bounding box in the bounding box.
			*
			* @property autoCenter
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			autoCenter: false,
			/**
			* Replaces an element with the same type and replace value.
			*
			* @property replace
			* @type {String}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default ''
			*/
			replace: '',
			/**
			* If a bounding box is set for an element, you can enable clipping, so the bounding box is the visible area for the element.
			*
			* @property boundingBoxClipping
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			boundingBoxClipping: false,
			/**
			* Selects the element when its added to stage.
			*
			* @property autoSelect
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			autoSelect: false,
			/**
			* Sets the element always on top.
			*
			* @property topped
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			topped: false,
			/**
			* Flips the element on the x-axis.
			*
			* @property flipX
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			flipX: false,
			/**
			* Flips the element on the y-axis.
			*
			* @property flipY
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default false
			*/
			flipY: false,
			/**
			* You can define different prices when using a range of colors, set through the colors option.
			*
			* @property colorPrices
			* @type {Object}
			* @for jQuery.fn.fancyProductDesigner.defaults.elementParameters
			* @default {}
			* @example colorPrices: {"000000": 2, "ffffff: "3.5"}
			*/
			colorPrices: {}
		},
		/**
		* An object containing the default text element parameters. See <a href="./jQuery.fn.fancyProductDesigner.defaults.textParameters.html">jQuery.fn.fancyProductDesigner.defaults.textParameters</a>. The properties in the object will merge with the properties in the elementParameters.
		*
		* @property textParameters
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Object}
		*/
		textParameters: {
			/**
			* If false it will use the first font from the fonts option (alphabetic order), otherwise it will use the font family set here.
			*
			* @property font
			* @type {Boolean | String}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default false
			*/
			font: false,
			/**
			* The text size in pixels.
			*
			* @property textSize
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default 18
			*/
			textSize: 18,
			/**
			* If true the user can set a pattern for the text element.
			*
			* @property patternable
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default false
			*/
			patternable: false,
			/**
			* If true the user can edit the text element.
			*
			* @property editable
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default true
			*/
			editable: true,
			/**
			* The line height in pixels.
			*
			* @property lineHeight
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default 1
			*/
			lineHeight: 1,
			/**
			* The alignment for the text element. Possible values: 'left', 'center' or 'right'.
			*
			* @property textAlign
			* @type {String}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default 'left'
			*/
			textAlign: 'left',
			/**
			* The font weight for the text element. Possible values: 'normal' or 'bold'.
			*
			* @property fontWeight
			* @type {String}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default 'normal'
			*/
			fontWeight: 'normal', //set the font weight - bold or normal
			/**
			* The font style for the text element. Possible values: 'normal' or 'italic'.
			*
			* @property fontStyle
			* @type {String}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default 'normal'
			*/
			fontStyle: 'normal',
			/**
			* The text decoration for the text element. Possible values: 'normal' or 'underline'.
			*
			* @property textDecoration
			* @type {String}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default 'normal'
			*/
			textDecoration: 'normal',
			/**
			* The maximal allowed characters. 0 means unlimited characters.
			*
			* @property maxLength
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default 0
			*/
			maxLength: 0,
			/**
			* If true the text will be curved.
			*
			* @property curved
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default false
			*/
			curved: false,
			/**
			* If true the the user can switch between curved and normal text.
			*
			* @property curvable
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default false
			*/
			curvable: false,
			/**
			* The letter spacing when the text is curved.
			*
			* @property curveSpacing
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default 10
			*/
			curveSpacing: 10,
			/**
			* The radius when the text is curved.
			*
			* @property curveRadius
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default 80
			*/
			curveRadius: 80,
			/**
			* Reverses the curved text.
			*
			* @property curveReverse
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.textParameters
			* @default false
			*/
			curveReverse: false
		},
		/**
		* An object containing the default image element parameters. See <a href="./jQuery.fn.fancyProductDesigner.defaults.imageParameters.html">jQuery.fn.fancyProductDesigner.defaults.imageParameters</a>. The properties in the object will merge with the properties in the elementParameters.
		*
		* @property imageParameters
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Object}
		*/
		imageParameters: {
			/**
			* If true the image will be used as upload zone. That means the image is a clickable area where the user can add different media types.
			*
			* @property uploadZone
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.imageParameters
			* @default false
			*/
			uploadZone: false,
			/**
			* Sets a filter on the image. Possible values: 'grayscale', 'sepia', 'sepia2'
			*
			* @property filter
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.imageParameters
			* @default false
			*/
			filter: false,
			/**
			* An array of filters the user can choose from.
			*
			* @property filter
			* @type {Array}
			* @for jQuery.fn.fancyProductDesigner.defaults.imageParameters
			* @default []
			* @example filters: ['grayscale', 'sepia', 'sepia2']
			*/
			filters: []
		},
		/**
		* An object containing the default parameters for custom added images. See <a href="./jQuery.fn.fancyProductDesigner.defaults.customImageParameters.html">jQuery.fn.fancyProductDesigner.defaults.customImageParameters</a>. The properties in the object will merge with the properties in the elementParameters and imageParameters.
		*
		* @property customImageParameters
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Object}
		*/
		customImageParameters: {
			/**
			* The minimum upload size width.
			*
			* @property minW
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.customImageParameters
			* @default 100
			*/
			minW: 100,
			/**
			* The minimum upload size height.
			*
			* @property minH
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.customImageParameters
			* @default 100
			*/
			minH: 100,
			/**
			* The maximum upload size width.
			*
			* @property maxW
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.customImageParameters
			* @default 1500
			*/
			maxW: 1500,
			/**
			* The maximum upload size height.
			*
			* @property maxH
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.customImageParameters
			* @default 1500
			*/
			maxH: 1500,
			/**
			* Resizes the uploaded image to this width.
			*
			* @property resizeToW
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.customImageParameters
			* @default 300
			*/
			resizeToW: 300,
			/**
			* Resizes the uploaded image to this height.
			*
			* @property resizeToH
			* @type {Number}
			* @for jQuery.fn.fancyProductDesigner.defaults.customImageParameters
			* @default 300
			*/
			resizeToH: 300
		},
		/**
		* An object containing additional parameters for custom added text.The properties in the object will merge with the properties in the elementParameters and textParameters.
		*
		* @property customTextParameters
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Object}
		*/
		customTextParameters: {},
		/**
		* An object containing the supported media types the user can add in the product designer.
		*
		* @property customAdds
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Object}
		*/
		customAdds: {
			/**
			* If true the user can add images from the designs library.
			*
			* @property designs
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.customAdds
			* @default true
			*/
			designs: true,
			/**
			* If true the user can upload an own image.
			*
			* @property uploads
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.customAdds
			* @default true
			*/
			uploads: true,
			/**
			* If true the user can add own text.
			*
			* @property texts
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.customAdds
			* @default true
			*/
			texts: true,
			/**
			* If true the user can add own photos from Facebook.
			*
			* @property facebook
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.customAdds
			* @default true
			*/
			facebook: true,
			/**
			* If true the user can add own photos from Instagram.
			*
			* @property instagram
			* @type {Boolean}
			* @for jQuery.fn.fancyProductDesigner.defaults.customAdds
			* @default true
			*/
			instagram: true
		},
		/**
		* An object containing all label texts used in the product designer.<br /><br />
		* layersButton: 'Manage Layers',<br />
		* addsButton: 'Add Something',<br />
		* productsButton: 'Change Products',<br />
		* moreButton: 'Actions',<br />
		* downloadImage: 'Download Image',<br />
		* print: 'Print',<br />
		* downLoadPDF: 'Download PDF',<br />
		* saveProduct: 'Save',<br />
		* loadProduct: 'Load',<br />
		* undoButton: 'Undo',<br />
		* redoButton: 'Redo',<br />
		* resetProductButton: 'Reset Product',<br />
		* zoomButton: 'Zoom',<br />
		* panButton: 'Pan',<br />
		* addImageButton: 'Add your own Image',<br />
		* addTextButton: 'Add your own text',<br />
		* enterText: 'Enter your text',<br />
		* addFBButton: 'Add photo from facebook',<br />
		* addInstaButton: 'Add photo from instagram',<br />
		* addDesignButton: 'Choose from Designs',<br />
		* fillOptions: 'Fill Options',<br />
		* color: 'Color',<br />
		* patterns: 'Patterns',<br />
		* opacity: 'Opacity',<br />
		* filter: 'Filter',<br />
		* textOptions: 'Text Options',<br />
		* changeText: 'Change Text',<br />
		* typeface: 'Typeface',<br />
		* lineHeight: 'Line Height',<br />
		* textAlign: 'Alignment',<br />
		* textAlignLeft: 'Align Left',<br />
		* textAlignCenter: 'Align Center',<br />
		* textAlignRight: 'Align Right',<br />
		* textStyling: 'Styling',<br />
		* bold: 'Bold',<br />
		* italic: 'Italic',<br />
		* underline: 'Underline',<br />
		* curvedText: 'Curved Text',<br />
		* curvedTextSpacing: 'Spacing',<br />
		* curvedTextRadius: 'Radius',<br />
		* curvedTextReverse: 'Reverse',<br />
		* transform: 'Transform',<br />
		* angle: 'Angle',<br />
		* scale: 'Scale',<br />
		* centerH: 'Center Horizontal',<br />
		* centerV: 'Center Vertical',<br />
		* flipHorizontal: 'Flip Horizontal',<br />
		* flipVertical: 'Flip Vertical',<br />
		* resetElement: 'Reset Element',<br />
		* fbSelectAlbum: 'Select an album',<br />
		* instaFeedButton: 'My Feed',<br />
		* instaRecentImagesButton: 'My Recent Images',<br />
		* editElement: 'Edit Element',<br />
		* productSaved: 'Product Saved!',<br />
		* lock: 'Lock',<br />
		* unlock: 'Unlock',<br />
		* remove: 'Remove',<br />
		* outOfContainmentAlert: 'Move it in his containment!',<br />
		* uploadedDesignSizeAlert: "Sorry! But the uploaded image size does not conform our indication of size.",<br />
		* initText: "Initializing product designer",<br />
		* myUploadedImgCat: "Your uploaded images",<br />
		* moveUp: 'Move Up',<br />
		* moveDown: 'Move Down'<br />
		*
		* @property labels
		* @for jQuery.fn.fancyProductDesigner.defaults
		* @type {Object}
		* @example $('#fpd').fancyProductDesigner({labels: {changeText: 'Enter your text'}})
		*/
		labels: {
			layersButton: 'Manage Layers',
			addsButton: 'Add Something',
			productsButton: 'Change Products',
			moreButton: 'Actions',
			downloadImage: 'Download Image',
			print: 'Print',
			downLoadPDF: 'Download PDF',
			saveProduct: 'Save',
			loadProduct: 'Load',
			undoButton: 'Undo',
			redoButton: 'Redo',
			resetProductButton: 'Reset Product',
			zoomButton: 'Zoom',
			panButton: 'Pan',
			addImageButton: 'Add your own Image',
			addTextButton: 'Add your own text',
			enterText: 'Enter your text',
			addFBButton: 'Add photo from facebook',
			addInstaButton: 'Add photo from instagram',
			addDesignButton: 'Choose from Designs',
			fillOptions: 'Fill Options',
			color: 'Color',
			patterns: 'Patterns',
			opacity: 'Opacity',
			filter: 'Filter',
			textOptions: 'Text Options',
			changeText: 'Change Text',
			typeface: 'Typeface',
			lineHeight: 'Line Height',
			textAlign: 'Alignment',
			textAlignLeft: 'Align Left',
			textAlignCenter: 'Align Center',
			textAlignRight: 'Align Right',
			textStyling: 'Styling',
			bold: 'Bold',
			italic: 'Italic',
			underline: 'Underline',
			curvedText: 'Curved Text',
			curvedTextSpacing: 'Spacing',
			curvedTextRadius: 'Radius',
			curvedTextReverse: 'Reverse',
			transform: 'Transform',
			angle: 'Angle',
			scale: 'Scale',
			centerH: 'Center Horizontal',
			centerV: 'Center Vertical',
			flipHorizontal: 'Flip Horizontal',
			flipVertical: 'Flip Vertical',
			resetElement: 'Reset Element',
			fbSelectAlbum: 'Select an album',
			instaFeedButton: 'My Feed',
			instaRecentImagesButton: 'My Recent Images',
			editElement: 'Edit Element',
			productSaved: 'Product Saved!',
			lock: 'Lock',
			unlock: 'Unlock',
			remove: 'Remove',
			outOfContainmentAlert: 'Move it in his containment!',
			uploadedDesignSizeAlert: "Sorry! But the uploaded image size does not conform our indication of size.",
			initText: "Initializing product designer",
			myUploadedImgCat: "Your uploaded images",
			moveUp: 'Move Up',
			moveDown: 'Move Down',
			modalSubmit: 'OK, got it!'
		}
	};

})(jQuery);