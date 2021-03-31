<template>
	<div>
		<nav class="bg-white border-b border-gray-100 md:block hidden">
			<!-- Primary Navigation Menu -->
			<div class="md:px-5 lg:px-6 px-4">
				<div class="flex justify-between h-16">
					<div class="flex">
						<div class="flex-shrink-0 flex items-center mr-5">
							<hamburger @hamburgerClicked="click"></hamburger>
						</div>
					</div>

					<div class="hidden sm:flex sm:items-center sm:ml-6">
						<!-- Settings Dropdown -->
						<div class="ml-3 relative">
							<breeze-dropdown align="right" width="48">
								<template #trigger>
									<span class="inline-flex rounded-md">
										<button
											type="button"
											class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
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
export default {
	components: {
		BreezeApplicationLogo,
		BreezeDropdown,
		BreezeDropdownLink,
		Hamburger,
	},

	emits: ["hamburgerClick"],

	methods: {
		click(clicked) {
			this.$emit("hamburgerClick", clicked);
		},
	},
};
</script>