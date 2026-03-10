window.copyPEVPostShortCode = id => {
	const inputEl = document.querySelector(`#pevPostShortCode-${id} input`);
	const tooltipEl = document.querySelector(`#pevPostShortCode-${id} span`);

	inputEl.select();
	inputEl.setSelectionRange(0, 30);
	document.execCommand('copy');

	tooltipEl.textContent = 'Copied Successfully!';
	setTimeout(() => {
		tooltipEl.textContent = 'Click to Copy';
	}, 1500);
}