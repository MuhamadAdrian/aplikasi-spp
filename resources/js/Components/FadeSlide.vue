<template>
	<transition
		enter-active-class="transition-all duration-200 ease-in-out"
		leave-active-class="transition-all duration-200 ease-in-out"
		enter-from-class="opacity-0 transform translate-x-3"
		enter-to-class="opacity-100 transform translate-x-0"
		leave-from-class="opacity-100 transform translate-x-0"
		leave-to-class="opacity-0 transform translate-x-3"
		class="ml-2"
	>
		<slot></slot>
	</transition>
</template>