import { TestBed, async } from '@angular/core/testing';

import { AuthService } from './auth.service';
import { HttpClientModule } from '@angular/common/http';
import { User, HttpLoginResponse, HttpResponseTypes } from '../../models/model';

describe('AuthService', () => {
  let service: AuthService;
  const url = 'https://uat-vizdomapi.azurewebsites.net/api/';

  beforeEach(() => TestBed.configureTestingModule({
    imports: [HttpClientModule]
  }));


  it('test user authentication with correct password', async(() => {
    service = TestBed.get(AuthService);
    service.baseUrl = url;
    expect(service).toBeTruthy();


    const user = new User();
    user.email = 'prashant@neurosensum.com';
    user.password = 'prashant';
    service.AuthenticateUser(user).then((response: string) => {
      expect(response).toBeDefined();
    });
  }));

  it('test user authentication with incorrect password', async(() => {
    service = TestBed.get(AuthService);
    service.baseUrl = url;
    expect(service).toBeTruthy();


    const user = new User();
    user.email = 'prashant@neurosensum.com';
    user.password = 'prashant@123';
    service.AuthenticateUser(user).then((response: string) => {
      fail('should have failed with the 403 error');
    }, (error: string) => {
      expect(error).toContain('Incorrect');
    });
  }));

  it('test user authentication with incorrect username', async(() => {
    service = TestBed.get(AuthService);
    service.baseUrl = url;
    expect(service).toBeTruthy();

    const user = new User();
    user.email = 'prashant1@neurosensum.com';
    user.password = 'prashant';
    service.AuthenticateUser(user).then((response: string) => {
      fail('should have failed with the 403 error');
    }, (error: string) => {
      expect(error).toContain('Incorrect');
    });
  }));


});
