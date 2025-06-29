import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ProfileHrgaPage } from './profile-hrga.page';

describe('ProfileHrgaPage', () => {
  let component: ProfileHrgaPage;
  let fixture: ComponentFixture<ProfileHrgaPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(ProfileHrgaPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
