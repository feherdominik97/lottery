// @ts-ignore
import { expect } from 'vitest';
// @ts-ignore
import { config } from '@vue/test-utils';

config.global.mocks = {
    $t: (msg: string) => msg,
};

expect.extend({
    toBeInstanceOf(received: any, constructor: { name: any; }) {
        // @ts-ignore
        const pass = received instanceof constructor;
        if (pass) {
            return {
                message: () => `expected ${received} not to be instance of ${constructor.name}`,
                pass: true,
            };
        } else {
            return {
                message: () => `expected ${received} to be instance of ${constructor.name}`,
                pass: false,
            };
        }
    },
});
