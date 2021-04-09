<template>
	<div>
		<nav
			class="bg-white dark:bg-gray-800 bg-color-transition md:block hidden"
		>
			<!-- Primary Navigation Menu -->
			<div class="md:px-5 lg:px-6 px-4">
				<div class="flex justify-between h-16">
					<div class="flex">
						<div class="flex-shrink-0 flex items-center mr-5">
							<hamburger @hamburgerClicked="click"></hamburger>
						</div>
					</div>

					<div class="hidden sm:flex sm:items-center sm:ml-6">
						<button
							@click="toggleTheme()"
							class="p-4 rounded-full relative shadow-light w-14 h-14 block"
						>
							<transition name="slide">
								<div
									class="absolute w-full h-full flex top-0 left-0 items-center justify-center"
									v-if="is_dark"
									key="dark"
								>
									<svg
										class="fill-current text-white"
										xmlns="http://www.w3.org/2000/svg"
										enable-background="new 0 0 24 24"
										height="24"
										viewBox="0 0 24 24"
										width="24"
									>
										<rect
											fill="none"
											height="24"
											width="24"
										/>
										<path
											d="M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36c-0.98,1.37-2.58,2.26-4.4,2.26 c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z"
										/>
									</svg>
								</div>
								<div
									class="absolute w-full h-full flex top-0 left-0 items-center justify-center"
									v-else
									key="day"
								>
									<svg
										xmlns="http://www.w3.org/2000/svg"
										enable-background="new 0 0 24 24"
										height="24"
										viewBox="0 0 24 24"
										width="24"
									>
										<rect
											fill="none"
											height="24"
											width="24"
										/>
										<path
											d="M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0 c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2 c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1 C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06 c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41 l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41 c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36 c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z"
										/>
									</svg>
								</div>
							</transition>
						</button>
						<!-- Settings Dropdown -->
						<div class="ml-3 relative">
							<breeze-dropdown align="right" width="48">
								<template #trigger>
									<span class="inline-flex rounded-md">
										<button
											type="button"
											class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
										>
											<span
												v-if="
													$page.props.auth.user
														.level == 'admin'
												"
												>{{
													$page.props.auth.user
														.nama_petugas
												}}
												(Admin)</span
											>
											<span
												v-if="
													$page.props.auth.user
														.level == 'petugas'
												"
												>{{
													$page.props.auth.user
														.nama_petugas
												}}
												(Petugas)</span
											>
											<span
												v-if="
													$page.props.auth.user
														.level == null
												"
												>{{
													$page.props.auth.user.nama
												}}</span
											>

											<svg
												class="ml-2 -mr-0.5 h-4 w-4"
												xmlns="http://www.w3.org/2000/svg"
												viewBox="0 0 20 20"
												fill="currentColor"
											>
												<path
													fill-rule="evenodd"
													d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
													clip-rule="evenodd"
												/>
											</svg>
										</button>
									</span>
								</template>

								<template #content>
									<breeze-dropdown-link
										:href="route('logout')"
										method="post"
										as="button"
									>
										Keluar
									</breeze-dropdown-link>
								</template>
							</breeze-dropdown>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo";
import BreezeDropdown from "@/Components/Dropdown";
import BreezeDropdownLink from "@/Components/DropdownLink";
import Hamburger from "@/Components/Hamburger";
import toggleTheme from "@/Helper/toggleTheme.js";
export default {
	components: {
		BreezeApplicationLogo,
		BreezeDropdown,
		BreezeDropdownLink,
		Hamburger,
	},

	mixins: [toggleTheme],

	emits: ["hamburgerClick"],

	methods: {
		click(clicked) {
			this.$emit("hamburgerClick", clicked);
		},
	},
};
</script>