<template>
	<div v-if="animationShowed">
		<svg
			version="1.1"
			id="Layer_1"
			xmlns="http://www.w3.org/2000/svg"
			xmlns:xlink="http://www.w3.org/1999/xlink"
			x="0px"
			y="0px"
			viewBox="0 0 24 24"
			style="enable-background: new 0 0 24 24"
			xml:space="preserve"
			class="animate-spin h-5 w-5 mr-3 op"
		>
			<path
				style="opacity: 0.74; fill: #ffffff"
				d="M12,0.8C5.8,0.8,0.8,5.8,0.8,12s5,11.2,11.2,11.2s11.2-5,11.2-11.2S18.2,0.8,12,0.8z
        M12,20c-4.4,0-8-3.6-8-8s3.6-8,8-8s8,3.6,8,8S16.4,20,12,20z"
			/>
			<linearGradient
				id="SVGID_1_"
				gradientUnits="userSpaceOnUse"
				x1="17.5769"
				y1="0.9738"
				x2="17.5769"
				y2="23.0261"
			>
				<stop offset="0" style="stop-color: #ffffff; stop-opacity: 0" />
				<stop offset="1" style="stop-color: #ffffff" />
			</linearGradient>
			<path
				style="fill: url(#SVGID_1_)"
				d="M12,2.5L12,2.5c0,0.8,0.6,1.4,1.4,1.5C17.1,4.7,20,8,20,12s-2.9,7.3-6.7,7.9
        C12.6,20,12,20.7,12,21.5v0c0,1,0.9,1.7,1.8,1.5c5.3-0.9,9.3-5.5,9.3-11s-4-10.1-9.3-11C12.9,0.8,12,1.6,12,2.5z"
			/>
		</svg>
	</div>
</template>

<script>
export default {
	props: ["animationShowed"],
};
</script>