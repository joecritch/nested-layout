<?php

/*
	Copyright 2013 Joe Critchley and other contributors
	http://joecritchley.com/

	Permission is hereby granted, free of charge, to any person obtaining
	a copy of this software and associated documentation files (the
	"Software"), to deal in the Software without restriction, including
	without limitation the rights to use, copy, modify, merge, publish,
	distribute, sublicense, and/or sell copies of the Software, and to
	permit persons to whom the Software is furnished to do so, subject to
	the following conditions:

	The above copyright notice and this permission notice shall be
	included in all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
	MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
	LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
	OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
	WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

class NestedLayout {

	public $html = '';

	public function end() {
		$outlet_content = ob_get_contents();
		ob_end_clean();
		echo str_replace('{{outlet}}', $outlet_content, $this->html);
	}

	public function getPartial($fileName, $locals) {
		ob_start();

		// Create some dynamic variables for use in the partial
		foreach($locals as $key => $val) {
			${$key} = $val;
		}

		include('partials/' . $fileName . '.php');

		// Delete the dynamic variables after the rendering.
		foreach($locals as $key => $val) {
			unset(${$key});
		}

		$this->html = ob_get_contents();
		ob_end_clean();
	}
}

// Treat this as a factory method which creates a new NestedLayout
function layout($fileName, $locals) {
	$nestedLayout = new NestedLayout();
	$nestedLayout->getPartial($fileName, $locals);

	// Start this to so we can now get the outlet content
	ob_start();
	return $nestedLayout;
}

// A simpler version, for when we don't need an {{outlet}}
function partial($fileName, $locals) {
	$nestedLayout = new NestedLayout();
	$nestedLayout->getPartial($fileName, $locals);
	$nestedLayout->html =  str_replace('{{outlet}}', '', $nestedLayout->html);
	echo $nestedLayout->html;
}

?>