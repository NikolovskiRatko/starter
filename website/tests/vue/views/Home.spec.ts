// import Vue from 'vue';
// import {
//   mount,
// } from '@vue/test-utils';

// import faker from 'faker';

// import configStore from '../mocks/config-store';
// import storeMock from '../mocks/store-mock';

// import Home from '@/views/admin/Dashboard.vue';

// const localState = {
//   homeItems: [{
//     name: faker.lorem.word(),
//     link: faker.internet.url(),
//     icon: faker.lorem.word(),
//   }, {
//     name: faker.lorem.word(),
//     link: faker.internet.url(),
//     icon: faker.lorem.word(),
//   }, {
//     name: faker.lorem.word(),
//     link: faker.internet.url(),
//     icon: faker.lorem.word(),
//   }],
//   homePath: '/',
// };

// const name = faker.name.findName();

// Vue.prototype.$auth = {
//   user: jest.fn(() => ({
//     name,
//   })),
// };

// storeMock.modules.Root.state = localState;

// describe('Home.vue', () => {
//   const store = configStore(Vue, storeMock);
//   let wrapper;

//   beforeEach(() => {
//     wrapper = mount(Home, {
//       store,
//     });
//   });

//   it('should have 3 HomeCard components and has a name with "Welcome" on the title', () => {
//     const welcome = 'Welcome';

//     expect(wrapper.find('h1').text()).toEqual(`${welcome}, ${name}`);
//     expect(wrapper.findAll('.home-card')).toHaveLength(localState.homeItems.length);

//     Vue.i18n.set('fr');
//   });

//   it('should have a name with "Bem-vindo" on the title', () => {
//     const welcome = 'Bem-vindo';

//     expect(wrapper.find('h1').text()).toEqual(`${welcome}, ${name}`);
//   });
// });
