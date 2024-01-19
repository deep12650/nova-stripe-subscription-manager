<template>
    <div>
        <div v-if="value && value.length > 0">
            <ul>
                <li v-for="subscription in value">
                    {{ subscription }}
                </li>
            </ul>
        </div>
        <div v-else>
            No subscriptions found.
        </div>
    </div>
</template>

<script>
    export default {
        props: ['value'],
    };
</script>
