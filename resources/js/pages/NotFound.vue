<template>
    <!-- begin error -->
		<div class="error">
			<div class="error-code">404</div>
			<div class="error-content">
				<div class="error-message">We couldn't find it...</div>
				<div class="error-desc mb-3 mb-sm-4 mb-md-5">
					The page you're looking for doesn't exist. <br />
					Perhaps, there pages will help find what you're looking for.
				</div>
				<div>
                    <router-link class="btn btn-success p-l-20 p-r-20" :to="{name: 'home'}">
                        Go Home
                    </router-link>
				</div>
			</div>
		</div>
		<!-- end error -->
</template>
