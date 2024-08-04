// @ts-ignore
import { mount } from '@vue/test-utils';
// @ts-ignore
import { describe, it, expect } from 'vitest';
import Matches from '../../components/Matches.vue';
describe('Matches', () => {
    it('is a Vue instance', () => {
        const component = mount(Matches);
        expect(component.html()).toContain('');
    });
});